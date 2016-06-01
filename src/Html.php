<?php
namespace Helpers;

/**
 * Class Html
 *
 * help to job with tags html
 *
 * @package Helpers
 * @author Jamie Ynonan <jamiea31@gmail.com>
 * @version 1.0.0
 */
Class Html
{
	use BaseHtmlTrait;

	/**
	 * @uses BaseHtmlTrait::BaseHtmlTrait
	 *
	 * @param string $text
	 * @param array $htmlOptions
	 * @return string
	 */
	public static function p($text, array $htmlOptions = [])
	{
		return '<p'. self::htmlOptions($htmlOptions) .'>'. $text . '</p>';
	}

	/**
	 * @uses BaseHtmlTrait::BaseHtmlTrait
	 *
	 * @param string $text
	 * @param array $htmlOptions
	 * @return string
	 */
	public static function button($text, array $htmlOptions = [])
	{
		return '<button'. self::htmlOptions($htmlOptions) .'>'. $text .'</button>';
	}

	/**
	 * @uses BaseHtmlTrait::BaseHtmlTrait
	 *
	 * @param string $text
	 * @param string $href
	 * @param array $htmlOptions
	 * @return string
	 */
	public static function a($text, $href, array $htmlOptions = [])
	{
		return '<a href="'. $href .'"'. self::htmlOptions($htmlOptions) .'>'
			. $text .'</a>';
	}
}