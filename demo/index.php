<?php

//include '../vendor/autoload.php';

interface test
{
	static function test ();
}

class A
{

	const CONFIG = 666;

	public static function test ()
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

