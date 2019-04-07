<?php

namespace Peak\Plugin\Debuger;

trait Standard
{

	private static $debug = [
		'msg' => null,
		'code' => null,
	];


	/**
	 * 设置debug
	 * @param $msg string
	 * @param $code int|float
	 * */
	public static function setDebug ($msg, $code=0)
	{
		if (!is_string($msg)) {
			throw new \Exception('"msg"参数必须是字符串。');
		}
		self::$debug['msg'] = $msg;
		self::$debug['code'] = $code;
	}


	/**
	 * 判断是否debug过
	 * */
	public static function isDebug ():bool
	{
		return isset(self::$debug['msg']);
	}


	/**
	 * 获取debug 消息
	 * @return string|null
	 * */
	public static function getDebugMsg ()
	{
		return self::$debug['msg'];
	}

	/**
	 * 获取debug 编码
	 * @return int|float
	 * */
	public static function getDebugCode ()
	{
		return self::$debug['code'];
	}





}