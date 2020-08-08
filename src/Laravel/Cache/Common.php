<?php

namespace Peak\Plugin\Laravel\Cache;

use Illuminate\Support\Facades\Cache;

trait Common
{


    use Config;

    /**
     * 删除缓存
     * @param string $key 键名主要值
     * @param string|array $ext 键名后缀，多个后缀以数组形式传入
     * @param mixed
     */
	static function getCache ($key, $ext='')
    {
        $key = self::cacheKey($key, $ext, static::class);
        return Cache::get($key);
    }


    /**
     * 设置缓存
     * @param string $key 键名主要值
     * @param mixed $val 缓存值
     * @param string|array $ext 键名后缀，多个后缀以数组形式传入
     * @return bool
     */
    static function setCache ($key, $val, $ext='') :bool
    {
        $key = self::cacheKey($key, $ext, static::class);
        return self::$cache_ini['exp'] ? Cache::put($key, $val, self::$cache_ini['exp']*60) : Cache::forever($key, $val);
    }


    /**
     * 删除缓存
     * @param string $key 键名主要值
     * @param string|array $ext 键名后缀，多个后缀以数组形式传入
     * @return bool
     */
    static function delCache ($key, $ext='') :bool
    {
        $key = self::cacheKey($key, $ext, static::class);
        return Cache::forget($key);
    }


}


