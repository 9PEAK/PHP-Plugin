<?php

namespace Peak\Plugin\Laravel\Cache\Redis;

use Illuminate\Support\Facades\Redis;

trait Config
{

    private static $redis_ini = [
        'exp' => 60, // 默认缓存60分钟
    ];

    protected static function redis_ini ($exp)
    {

    }


    protected static function redis_cli (&$key) :Redis
    {
        $redis = Redis::connection();
        $key = Common::cacheKey('', $key, static::class);
        return $redis;
    }


}
