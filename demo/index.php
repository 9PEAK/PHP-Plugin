<?php

//include '../vendor/autoload.php';

class A
{
	const CONFIG = [
		'status' => [
			0 => '未完成',
			1 => '已完成',
		],

		'error' => [
			'1.1' => '账号密码错误',
			'1.2' => '登录未授权',
			'1.3' => '账号权限不足',
		],
	];

	public function test ()
	{
		return defined('self::CONFIG');
	}
}

$a = new A();
echo $a->test() ? 1 : 0;

//$str = str(-10);
//
//$str = str_random(5, -10);
//
//print_r($str);

