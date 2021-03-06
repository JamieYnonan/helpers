<?php
namespace Helpers;

/**
 * Class ArrayH
 *
 * Help to job with arrays
 *
 * @package Helpers
 * @author Jamie Ynonan <jamiea31@gmail.com>
 * @link https://github.com/yiisoft/yii2/blob/master/framework/helpers/BaseArrayHelper.php
 * @version 1.0.0
 */
class ArrayH
{
    /**
     * @param array $array
     * @param string $from
     * @param string $to
     * @param null $group
     * @return array
     */
	public static function map(array $array, $from, $to, $group = null)
    {
        $result = [];
        foreach ($array as $element) {
            $key = static::getValue($element, $from);
            $value = static::getValue($element, $to);
            if ($group !== null) {
                $result[static::getValue($element, $group)][$key] = $value;
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    /**
     * @param array $array
     * @param mixed $key
     * @param null|mixed $default
     * @return mixed|null
     */
    public static function getValue(array $array, $key, $default = null)
    {
        if (is_array($key)) {
            $lastKey = array_pop($key);
            foreach ($key as $keyPart) {
                $array = static::getValue($array, $keyPart);
            }
            $key = $lastKey;
        }

        if (is_array($array) && array_key_exists($key, $array)) {
            return $array[$key];
        }

        if (($pos = strrpos($key, '.')) !== false) {
            $array = static::getValue($array, substr($key, 0, $pos), $default);
            $key = substr($key, $pos + 1);
        }

        if (is_array($array)) {
            return array_key_exists($key, $array) ? $array[$key] : $default;
        }
        return $default;
    }
}
