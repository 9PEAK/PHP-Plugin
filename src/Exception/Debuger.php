<?php

namespace Peak\Plugin\Exception;

trait Debuger
{

	private static $debug;

	public static function debug ($e=null)
	{
		if (isset($e)) {
			self::$debug = $e;
		} else {
			return self::$debug;
		}
	}
	
}
