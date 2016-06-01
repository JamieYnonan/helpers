<?php

class BaseHtmlTraitTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider optionsProvider
     */
    public function testHtmlOptions($expected, array $options)
    {
        $mock = $this->getMockForTrait('\Helpers\BaseHtmlTrait');
        $this->assertEquals($expected, $mock::htmlOptions($options));
    }

    public function optionsProvider()
    {
        return [
            [
                ' id="first-id" class="first-class" name="name"',
                ['id' => 'first-id', 'class' => 'first-class', 'name' => 'name']
            ],
            [
                ' id="id" class="class" name="first_name" data-value="value"',
                [
                    'id' => 'id',
                    'class' => 'class',
                    'name' => 'first_name',
                    'data-value' => 'value'
                ]
            ],
            ['', []]
        ];
    }
}
