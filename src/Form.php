<?php
namespace Helper;

class Form extends BaseHtml
{

    public static function open(
        $method = 'POST',
        $action = '',
        array $options = []
    ) {
        $form = '<form method="'. $method .'" action="'. $action .'"'
            . self::htmlOptions($options) .'>';
        return $form;
    }

    public static function close()
    {
        return '</form>';
    }

    public static function submit($value = '', array $options = [])
    {
        $submit = '<button type="submit"'. self::options($options) .'>';
        $submit .= $value .'</button>';
        return $submit;
    }

    public static function text($name, $value = '', array $options = [])
    {
    	$text = self::input('text', $name, $value)
    		. self::htmlOptions($options) .'>';
    	return $text;
    }

    public static function password($name, array $options = [])
    {
        $pass = self::input('password', $name)
            . self::htmlOptions($options);
        return $pass;
    }

    public static function hidden($name, $value = '', array $options = [])
    {
        $hidden = self::input('hidden', $name, $value)
            . self::htmlOptions($options);
        return $hidden;
    }

    public static function email($name, $value = '', array $options = [])
    {
        $email = self::input('email', $name, $value)
            . self::htmlOptions($options) .'>';
        return $email;
    }

    public static function radio(
        $name,
        $value,
        $checked = null,
        array $options = []
    ) {
    	$radio = self::input('radio', $name, $value);
    	if ($checked == $value) {
    		$radio .= ' checked="checked"';
    	}
    	$radio .= self::htmlOptions($options) .'>';
    	return $radio;
    }

    public static function checkbox(
        $name,
        $value,
        array $checkeds = [],
        array $options = []
    ) {
        $check = self::input('checkbox', $name, $value);
        $check .= 'value="'.$value.'"';
        if (in_array($value, $checkeds)) {
            $check .= ' checked="checked"';
        }
        $check .= self::htmlOptions($options) .'>';
        return $check;
    }

    public static function textarea($name, $value = '', array $options = [])
    {
        $text = '<textarea name="'. $name .'"';
        $text .= self::htmlOptions($options) .'>';
        $text .= $value .'</textarea>';
        return $text;
    }

    public static function select(
        $name,
        array $options = [],
        $value = null,
        $multiple = false,
        array $htmlOptions = []
    ) {
        $select = '<select name="'. $name .'"'. self::htmlOptions($htmlOptions);
        if ($multiple === true) {
            $select .= ' multiple';
        }
        $select .= '>';
        $select .= self::selectOptions($options, $value, $multiple);
        $select .= '</select>';
        return $select;
    }

    public static function label($text, array $htmlOptions = [])
    {
        return '<label' . self::htmlOptions($htmlOptions) .'>'
            . $text .'</label>';
    }

    private static function selectOptions(
        array $options = [],
        $actualValue = '',
        $multiple = false
    ) {
        $option = '';
        $selected = '';
        foreach ($options as $value => $label) {
            if (is_array($label)) {
                $option .= '<optgroup label="'. $value .'">';
                $option .= self::selectOptions($label, $actualValue, $multiple);
                $option .= '</optgroup>';
            } else {
                if ($value == $actualValue) {
                    $selected = ' selected';
                }
                $selected = (!empty($value) && (
                    ($multiple === true && in_array($value, $actualValue)) ||
                    ($multiple === false && $value == $actualValue)
                )) ? ' selected' : '';
                $option .= '<option value="'. $value .'"'. $selected .'>'
                    . $label .'</option>';
            }
        }
        return $option;
    }

    private static function input($type, $name, $value = '')
    {
        return '<input type="'. $type .'" name="'. $name .'" value="'
            . $value .'"';
    }
}
