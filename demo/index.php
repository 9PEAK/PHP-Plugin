<?php

namespace Hello;
//include '../vendor/autoload.php';

interface test
{
	static function test ();
}

class A
{

	const CONFIG = 666;

	private $x = 666;

	public static function test ()
	{
		return defined('self::CONFIG');
	}
}

$a = new A();
//echo $a->test();

$arr = [
	A::class => 666,
];

$arr = json_encode($arr);
echo $arr;

