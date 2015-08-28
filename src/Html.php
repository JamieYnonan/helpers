<?php
namespace Helper;

Class Helper extends BaseHtml
{
	public static function p($text, array $options = [])
	{
		return '<p'. self::htmlOptions($options) .'>'. $text . '</p>';
	}

	public static function button($text, array $options = [])
	{
		return '<button'. self::htmlOptions($options) .'>'. $text .'</button>';
	}

	public static function a($text, $href, array $options = [])
	{
		return '<a href="'. $href .'"'. self::htmlOptions($options) .'>'
			. $text .'</a>';
	}
}