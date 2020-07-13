<?php

//const STR = [
//    -1 => 'abcdefghijklmnopqrstuvwxyz',
//    0 => '1234567890',
//    1 => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
//];


/**
 * 返回字符串原材料
 * @param string $type 1 upper letter, -1 lower letter, 0 integer.
 * */
function string ($type)
{
    $type = (string)$type;
    $material = [
        -1 => 'abcdefghijklmnopqrstuvwxyz',
        0 => '1234567890',
        1 => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ];
    foreach ( $material as $i=>$unit ) {
        if (stripos($type, (string)$i)===false) {
            unset ($material[$i]);
        } else {
            $type = str_replace($i, '', $type);
        }
    }
    return join('', $material);
}


/**
 * 生成随机字符串（大小写字母和数字）
 * @param int $size 长度
 * @param string $type 类型
 * @return bool|string
 */
function string_random ($size=4, $type='-101') {
    $code = string($type);
    $code = str_shuffle($code);
    return substr($code, 0, $size);
}


abstract class Str {


	static function caseCamel ($str, $separator='_')
	{
		$str = $separator. str_replace($separator, ' ', strtolower($str));
		return ltrim(str_replace(' ', '', ucwords($str)), $separator );
	}

	static function caseTitle ($str, $separator='_')
	{
		return ucfirst(self::caseCamel($str, $separator));
	}


	static function caseUnderscore($str, $separator='_')
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', "$1" . $separator . "$2", $str));
    }

}
