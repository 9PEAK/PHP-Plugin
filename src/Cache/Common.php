<?php

namespace Peak\Plugin\Cache;

trait Common
{

	protected static function cacheKey ($id)
	{
		return static::class.':'.(string)$id;
	}

}
