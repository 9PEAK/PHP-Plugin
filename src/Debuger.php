<?php

namespace Peak\Plugin;

trait Debuger
{

	private static $debug;

	public static function debug ($error=null)
	{
		if (isset($error)) {
			self::$debug = $error;
		} else {
			return self::$debug;
		}
	}
	
}
