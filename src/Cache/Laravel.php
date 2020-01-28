<?php

namespace Peak\Plugin\Cache;

use Illuminate\Support\Facades\Cache;

trait Laravel
{

    use Common;


	public static function cacheSet ($key, $val, $exp=60):bool
	{
		$key = self::cacheKey($key);
		$exp>0 ? Cache::put($key, $val, $exp) : Cache::forever($key, $val);
		return true;
	}



	public static function cacheGet ($key)
	{
		return Cache::get(self::cacheKey($key));
	}



	public static function cacheDel ($key=null)
	{
		Cache::forget(self::cacheKey($key));
		return true;
	}


}
