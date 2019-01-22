<?php

namespace Peak\Plugin;

trait JsonResponser
{

	/**
	 * 构造返回值结构【底层】
	 * @param $res int|float 编码
	 * @param $msg string 文字说明
	 * @param $dat mixed 数据
	 * */
	static function resRaw ($res, $msg, $dat)
	{
		return [
			'res' => $res,
			'msg' => (string)$msg,
			'dat' => $dat,
		];
	}

	/**
	 * 成功 res=1
	 * */
	static function resSuccess ($msg='', $dat=null)
	{
		return self::resRaw (1, $msg, $dat);
	}



	/**
	 * 失败 res=0
	 * */
	static function resFail ($msg='', $dat=null)
	{
		return self::resRaw(0, $msg, $dat);
	}


	### -1.* 和登录、验证有关

	/**
	 * 未登录 res=-1
	 * */
	static function resLogin ($msg='', $dat=null)
	{
		return self::resRaw(-1, $msg, $dat);
	}


	/**
	 * 未跳转 res=-1.1
	 * */
	static function resOAuth ($msg='', $dat=null)
	{
		return self::resRaw(-1.1, $msg, $dat);
	}


	/**
	 * 无权限 res=-1.2
	 * */
	static function resPermission ($msg='', $dat=null)
	{
		return self::resRaw(-1.2, $msg, $dat);
	}


	/**
	 * Toke错误 res=-1.3 适用于api或micro service
	 * */
	static function resToken ($msg='', $dat=null)
	{
		return self::resRaw(-1.3, $msg, $dat);
	}



}