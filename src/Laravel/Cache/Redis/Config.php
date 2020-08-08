<?php

namespace Peak\Plugin\Laravel\Cache\Redis;

trait Config
{

    private static $redis_ini = [
        'exp' => 60, // 默认缓存60分钟
    ];

    protected static function redis_ini ($exp)
    {

    }


}
