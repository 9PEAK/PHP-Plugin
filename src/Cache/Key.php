<?php

namespace Peak\Plugin\Cache;

trait Key
{

	protected static function key ($id)
	{
		return static::class.':'.$id;
	}


}