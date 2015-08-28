<?php
namespace Helper;

abstract class BaseHtml
{
	public static function htmlOptions(array $options)
	{
		$return = '';
		foreach ($options as $k => $v) {
			$return .= ' ' . $k .'="'. $v .'"';
		}
		return $return;
	}
}