<?php

namespace Peak\Plugin\Debuger;

trait Base
{

	private static $debug;

	public static function debug ($error=null)
	{
		if (isset($error)) {
			self::$debug = $error;
			return false;
		} else {
			return self::$debug;
		}
	}


}