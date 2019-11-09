<?php

/**
 * 数组转对象
 * @return \stdClass
 */
function array_to_obj (array $arr)
{
    return json_decode(json_encode($arr));
}


/**
 * 将数组里的元素转化为utf8
 * 深度转化，递归至最深层次的数组元素
 * */
function array_utf8 (array &$arr) {
    foreach ( $arr as &$v ) {
        if (is_array($v)) {
            (__FUNCTION__)($v);
        } else {
            $v = mb_convert_encoding($v, 'UTF-8', 'Windows-1252');
        }
    }
    return $arr;
}

function arrInitUnit ($arr)
{

}

abstract class Arr {


	/**
	 *
	 * */
	static function reset_key (array $arr, $type, $recursive=true, $glue='_')
	{
		/*
		switch ($type) {
			case 'UNDERSCORE':
				$func = 'caseUnderscore';
				break;

			case 'CAMEL':
				$func = 'caseCamel';
				break;

			case 'TITLE':
				$func = 'caseTitle';
		}*/
		$func = [
			'UNDERSCORE', 'CAMEL', 'TITLE'
		];
		if (!in_array($type, $func)) {
			throw new\Exception('Can\'t support the given type ('.$type.'). Only '.join(', ',$func). ' are available.');
		}

		$func = 'case'.ucfirst(strtolower($type));
		foreach ($arr as $key=>$val) {
			unset ($arr[$key]);
			$arr[Str::$func($key, $glue)] = is_array($val)&&$recursive ? self::{__FUNCTION__}($val, $type, true, $glue) : $val;
		}

		return $arr;
	}



	/**
	 * array to object or object to array (数组和对象类型转换)
	 * @param $dat
	 * @param $to string, object or array, the result type
	 * @param $recursive boolean, if convert data recursively
	 * */
	static function convert ($dat, $to='object', $recursive=false)
	{
		if (is_array($dat)||is_object($dat)) {
			$dat = $to=='object' ? (object)$dat : (array)$dat;

			if ($recursive) {
				foreach ($dat as &$val) {
					$val = self::{__FUNCTION__}($val, $to, true);
				}
			}
		}
		return $dat;

	}




	/**
	 * 数组取交集（格式化）
	 * @param $tpl 格式化的模板
	 * @param $dat 要格式化的数据
	 * @param $default 是否$tpl中的值作为作为默认值
	 * */
	static function intersectKey (array $tpl, array $dat, $default=false)
	{
		$dat = array_intersect_key($dat, $tpl);
		return $default ? array_merge($tpl, $dat) : $dat;
	}


}



/**
 * 重置数组每个元素的值
 * @param array $arr 数组
 * @param mixed $val 重置的值
 * */
function array_reset (array $arr, $val=null)
{
    foreach ($arr as &$unit) {
        $unit = $val;
    }
    return $arr;
}


/**
 * 翻转数组，并给每个元素设置初始值 flip array, and set each item as a default value（。）
 * @param array $arr
 * @param mixed $default 默认null
 * */
function array_flip_with_val (array $arr, $default=null)
{
    return array_reset(array_flip($arr), $default);
}


/**
 * 结合数组的key和value
 * @param array $arr 待处理的数组数据
 * @param string $kv 连接符
 * */
function array_join (array $arr, $kv='=')
{
    foreach ($arr as $key=>&$val) {
        $val = $key.$kv.$val;
    }
    return $arr;
}


function array_join_to_str (array $arr, $kv='=', $glue='&')
{
    return join($glue, array_join($arr, $kv));
}
