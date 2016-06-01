<?php

class HtmlTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider pProvider
     */
    public function testP($expected, $text, array $options = [])
    {
        $this->assertEquals($expected, \Helpers\Html::p($text, $options));
    }

    public function pProvider()
    {
        return [
            ['<p></p>', ''],
            ['<p>second</p>', 'second'],
            ['<p class="options">option</p>', 'option', ['class' => 'options']]
        ];
    }

    /**
     * @dataProvider buttonProvider
     */
    public function testButton($expected, $text, array $options = [])
    {
        $this->assertEquals($expected, \Helpers\Html::button($text, $options));
    }

    public function buttonProvider()
    {
        return [
            ['<button></button>', ''],
            ['<button>text button</button>', 'text button'],
            [
                '<button class="btn btn-danger">button</button>',
                'button',
                ['class' => 'btn btn-danger']
            ]
        ];
    }

    /**
     * @dataProvider aProvider
     */
    public function testA($expected, $text, $href, array $options = [])
    {
        $this->assertEquals($expected, \Helpers\Html::a($text, $href, $options));
    }

    public function aProvider()
    {
        return [
            ['<a href=""></a>', '', ''],
            ['<a href="#">link</a>', 'link', '#'],
            ['<a href="default.php">link</a>', 'link', 'default.php'],
            [
                '<a href="/default" class="disabled">link</a>',
                'link',
                '/default',
                ['class' => 'disabled']
            ]
        ];
    }
}
