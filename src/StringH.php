<?php
namespace Helper;

Class General
{
	/*
	 * https://github.com/yiisoft/yii2/blob/master/framework/helpers/BaseInflector.php
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