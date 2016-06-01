<?php

class FormTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider openProvider
     */
    public function testOpen($expected, $method = 'POST', $action = '')
    {
        $this->assertEquals($expected, \Helpers\Form::open($method, $action));
    }

    public function openProvider()
    {
        return [
            ['<form method="POST" action="">'],
            ['<form method="GET" action="/form.php">', 'GET', '/form.php']
        ];
    }

    public function testClose()
    {
        $this->assertEquals('</form>', \Helpers\Form::close());
    }

    public function testSubmit()
    {
        $this->assertEquals(
            '<button type="submit">Send</button>',
            \Helpers\Form::submit('Send')
        );
    }

    public function testLabel()
    {
        $this->assertEquals('<label>text label</label>', \Helpers\Form::label('text label'));
    }

    /**
     * @dataProvider textProvider
     */
    public function testText($expected, $name, $value = '')
    {
        $this->assertEquals($expected, \Helpers\Form::text($name, $value));
    }

    public function textProvider()
    {
        return [
            ['<input type="text" name="name_input" value="">', 'name_input'],
            ['<input type="text" name="name" value="Value">', 'name', 'Value']
        ];
    }

    public function testPassword()
    {
        $this->assertEquals(
            '<input type="password" name="pass" value="">',
            \Helpers\Form::password('pass'));
    }

    /**
     * @dataProvider hiddenProvider
     */
    public function testHidden($expected, $name, $value = '')
    {
        $this->assertEquals($expected, \Helpers\Form::hidden($name, $value));
    }

    public function hiddenProvider()
    {
        return [
            ['<input type="hidden" name="name" value="">', 'name'],
            ['<input type="hidden" name="name" value="Value">', 'name', 'Value']
        ];
    }

    /**
     * @dataProvider emailProvider
     */
    public function testEmail($expected, $name, $value = '')
    {
        $this->assertEquals($expected, \Helpers\Form::email($name, $value));
    }

    public function emailProvider()
    {
        return [
            ['<input type="email" name="email" value="">', 'email'],
            [
                '<input type="email" name="email" value="example@mail.com">',
                'email',
                'example@mail.com'
            ]
        ];
    }

    /**
     * @dataProvider radioProvider
     */
    public function testRadio(
        $expected,
        $name,
        $value,
        $checkedValue = null
    ) {
        $this->assertEquals($expected, \Helpers\Form::radio($name, $value, $checkedValue));
    }

    public function radioProvider()
    {
        return [
            [
                '<input type="radio" name="radio_name" value="radio_value">',
                'radio_name',
                'radio_value'
            ],
            [
                '<input type="radio" name="name" value="1" checked="checked">',
                'name',
                '1',
                '1'
            ],
            [
                '<input type="radio" name="name" value="1">',
                'name',
                '1',
                '2'
            ]
        ];
    }

    /**
     * @dataProvider checkboxProvider
     */
    public function testCheckbox(
        $expected,
        $name,
        $value,
        array $checkeds = []
    ) {
        $this->assertEquals($expected, \Helpers\Form::checkbox($name, $value, $checkeds));
    }

    public function checkboxProvider()
    {
        return [
            [
                '<input type="checkbox" name="check_name" value="1">',
                'check_name',
                '1'
            ],
            [
                '<input type="checkbox" name="name" value="1" checked="checked">',
                'name',
                '1',
                ['1']
            ],
            [
                '<input type="checkbox" name="name" value="1" checked="checked">',
                'name',
                '1',
                [3, 2, 1]
            ],
            [
                '<input type="checkbox" name="name" value="1">',
                'name',
                '1',
                ['2']
            ]
        ];
    }

    /**
     * @dataProvider textareaProvider
     */
    public function testTextarea($expected, $name, $text = '')
    {
        $this->assertEquals($expected, \Helpers\Form::textarea($name, $text));
    }
    
    public function textareaProvider()
    {
        return [
            ['<textarea name="name"></textarea>', 'name'],
            ['<textarea name="name">text</textarea>', 'name', 'text']
        ];
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage if $multiple is false, $value can not be array
     */
    public function testSelectFailForNotMultipleAndValueArrayException()
    {
        \Helpers\Form::select(
            'select_name',
            ['1' => 'first', '2' => 'second'],
            [1, 2],
            false
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage if $multiple is true, $value must be array
     */
    public function testSelectFailForMultipleAndValueNotArrayException()
    {
        \Helpers\Form::select(
            'select_name',
            ['1' => 'first', '2' => 'second'],
            1,
            true
        );
    }

    /**
     * @dataProvider selectMultipleFalseProvider
     */
    public function testSelectMultipleFalse(
        $expected,
        $name,
        array $options = [],
        $value = null,
        $multiple = false
    ) {
        $this->assertEquals(
            $expected,
            \Helpers\Form::select($name, $options, $value, $multiple)
        );
    }

    public function selectMultipleFalseProvider()
    {
        $expected = '<select name="select"><option value="1">first</option>'
            .'<option value="2">second</option></select>';

        $expected2 = '<select name="select"><option value="1">first</option>'
            .'<option value="2" selected>second</option></select>';

        return [
            ['<select name="select"></select>', 'select'],
            [$expected, 'select', ['1' => 'first', '2' => 'second']],
            [$expected2, 'select', ['1' => 'first', '2' => 'second'], 2]
        ];
    }

    /**
     * @dataProvider selectMultipleTrueProvider
     */
    public function testSelectMultipleTrue(
        $expected,
        $name,
        array $options = [],
        $value = null,
        $multiple = true
    ) {
        $this->assertEquals(
            $expected,
            \Helpers\Form::select($name, $options, $value, $multiple)
        );
    }

    public function selectMultipleTrueProvider()
    {
        $expected = '<select name="select" multiple><option value="1">first</option>'
            .'<option value="2">second</option></select>';

        $expected2 = '<select name="select" multiple><option value="1">first</option>'
            .'<option value="2" selected>second</option></select>';

        $expected3 = '<select name="select" multiple><option value="1" selected>first</option>'
            .'<option value="2" selected>second</option></select>';

        return [
            [$expected, 'select', ['1' => 'first', '2' => 'second'], []],
            [$expected, 'select', ['1' => 'first', '2' => 'second'], [3]],
            [$expected2, 'select', ['1' => 'first', '2' => 'second'], [2]],
            [$expected2, 'select', [1 => 'first', 2 => 'second'], [2]],
            [$expected3, 'select', [1 => 'first', 2 => 'second'], [1, 2]]
        ];
    }

    /**
     * @dataProvider selectMultipleFalseAndOpntionsProvider
     */
    public function testSelectMultipleFalseAndOptions(
        $expected,
        $name,
        array $options = [],
        $value = null,
        $multiple = false
    ) {
        $this->assertEquals(
            $expected,
            \Helpers\Form::select($name, $options, $value, $multiple)
        );
    }

    public function selectMultipleFalseAndOpntionsProvider()
    {
        $expected = '<select name="select">'
            .'<option value="1">first</option>'
            .'<option value="2">second</option>'
            .'<optgroup label="cars"></optgroup>'
            .'</select>';

        $expected2 = '<select name="select">'
            .'<option value="1">first</option>'
            .'<option value="2">second</option>'
            .'<optgroup label="cars">'
            .'<option value="car1" selected>First Car</option>'
            .'</optgroup>'
            .'</select>';

        return [
            [$expected, 'select', ['1' => 'first', '2' => 'second', 'cars' => []]],
            [
                $expected2,
                'select',
                [1 => 'first', 2 => 'second', 'cars' => ['car1' => 'First Car']],
                'car1'
            ]
        ];
    }

    /**
     * @dataProvider selectMultipleTrueAndOpntionsProvider
     */
    public function testSelectMultipleTrueAndOptions(
        $expected,
        $name,
        array $options = [],
        $value = null,
        $multiple = true
    ) {
        $this->assertEquals(
            $expected,
            \Helpers\Form::select($name, $options, $value, $multiple)
        );
    }

    public function selectMultipleTrueAndOpntionsProvider()
    {
        $expected = '<select name="select" multiple>'
            .'<option value="1">first</option>'
            .'<option value="2">second</option>'
            .'<optgroup label="cars"></optgroup>'
            .'</select>';

        $expected2 = '<select name="select" multiple>'
            .'<option value="1" selected>first</option>'
            .'<option value="2">second</option>'
            .'<optgroup label="cars">'
            .'<option value="car1" selected>First Car</option>'
            .'</optgroup>'
            .'</select>';

        return [
            [
                $expected,
                'select',
                ['1' => 'first', '2' => 'second', 'cars' => []],
                []
            ],
            [
                $expected2,
                'select',
                [1 => 'first', 2 => 'second', 'cars' => ['car1' => 'First Car']],
                [1, 'car1']
            ]
        ];
    }
}
