<?php
namespace Helpers;

/**
 * Class StringH
 *
 * help to to job with strings
 *
 * @package Helpers
 * @author Jamie Ynonan <jamiea31@gmail.com>
 * @link https://github.com/yiisoft/yii2/blob/master/framework/helpers/BaseInflector.php
 * @version 1.0.0
 */
Class StringH
{

    /**
     * @var array
     */
	public static $transliteration = [
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
        'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
        'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
        'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
        'ß' => 'ss',
        'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
        'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
        'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
        'ÿ' => 'y',
    ];

    /**
     * @param string $string
     * @param string $replacement
     * @param bool $lowercase
     * @return string
     */
    public static function slug($string, $replacement = '-', $lowercase = true)
    {
        $string = static::transliterate($string);
        $string = preg_replace('/[^a-zA-Z0-9=\s—–-]+/u', '', $string);
        $string = preg_replace('/[=\s—–-]+/u', $replacement, $string);
        $string = trim($string, $replacement);
        return $lowercase ? strtolower($string) : $string;
    }

    /**
     * @param string $string
     * @return mixed
     */
    protected static function transliterate($string)
    {
        return str_replace(array_keys(static::$transliteration), static::$transliteration, $string);
    }

    /**
     * @param string $name
     * @param bool $ucwords
     * @return string
     */
	public static function camel2words($name, $ucwords = true)
	{
		$label = trim(strtolower(str_replace([
			'-',
			'_',
			'.'
		], ' ', preg_replace('/(?<![A-Z])[A-Z]/', ' \0', $name))));
		return $ucwords ? ucwords($label) : $label;
	}

    /**
     * @param string $name
     * @param string $separator
     * @param bool $strict
     * @return string
     */
    public static function camel2id($name, $separator = '-', $strict = false)
    {
        $regex = $strict ? '/[A-Z]/' : '/(?<![A-Z])[A-Z]/';
        if ($separator === '_') {
            return trim(strtolower(preg_replace($regex, '_\0', $name)), '_');
        } else {
            return trim(
            	strtolower(
	            	str_replace(
		            	'_',
		            	$separator,
		            	preg_replace($regex, $separator . '\0', $name)
	            	)
	            ),
            	$separator
            );
        }
    }
}