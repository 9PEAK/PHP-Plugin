<?php

namespace Peak\Plugin;

trait Debuger
{

	private static $debug;

	public static function debug ($dat=null)
	{
		if ($dat) {
			self::$debug = $dat;
		} else {
			return self::$debug;
		}
	}


}