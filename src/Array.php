<?php
namespace Helper;

/*
 * https://github.com/yiisoft/yii2/blob/master/framework/helpers/BaseArrayHelper.php
 */
class Array
{
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
        } else {
            return $default;
        }
    }
}