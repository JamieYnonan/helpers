<?php
namespace Helpers;

/**
 * Class BaseHtmlTrait
 * 
 * @package Helpers
 * @author Jamie Ynonan <jamiea31@gmail.com>
 * @version 1.0.0
 */
trait BaseHtmlTrait
{
	/**
	 * @param array $options key = attribute and value = value
	 * @return string
     *
	 */
	public static function htmlOptions(array $options)
	{
		$return = '';
		foreach ($options as $k => $v) {
			$return .= ' ' . $k .'="'. $v .'"';
		}
		return $return;
	}
}