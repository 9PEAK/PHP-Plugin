<?php

namespace Peak\Plugin\Laravel\Cache\Redis;

use Illuminate\Support\Facades\Redis;

trait Config
{

    private static $redisIni = [
        'exp' => 60, // 默认缓存60分钟
    ];

    protected static function redisIni ($exp)
    {
        self::$redisIni = [
            'exp' => (int)$exp,
        ];
    }


    protected static function redisCli (&$key) :\Illuminate\Redis\Connections\PredisConnection
    {
        $redis = Redis::connection();
        $key = \Peak\Plugin\Laravel\Cache\Common::cacheKey('', $key, static::class);
        return $redis;
    }


}
