<?php

namespace Peak\Plugin\Cache;

trait Common
{

	protected static function key ($id)
	{
		return static::class.':'.(string)$id;
	}

}
