<?php

namespace Peak\Plugin;

trait Debuger
{

	private static $debug;


	public static function debug ($msg=null, $code=0, $previous=null)
	{
		if ($msg||$code) {
			self::$debug = new \Exception($msg, $code, $previous);
			throw self::$debug;
		} else {
			return self::$debug;
		}
	}


}