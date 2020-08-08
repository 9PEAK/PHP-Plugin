<?php

namespace Peak\Plugin\Laravel\Cache\Redis;

use Illuminate\Support\Facades\Redis;
use \Peak\Plugin\Laravel\Cache\Config as Common;

trait Hash
{


    use Config;


    /**
     * 获取所有的KEY
     * @param string $ext 扩展
     * @param bool $flip 是否反转结果
     * @return array
     */
    static function getKeys ($ext='', $flip=false)
    {
        $redis = Redis::connection();
        $res = $redis->hkeys(self::setKey($ext));
        return $flip ? array_flip($res) : $res;
    }



    /**
     * 将哈希表 key 中的字段 field 的值设为 value
     * @param string|array $key 键名，如果是数组则将按照数组key顺序排序后组合成字符串
     * @param string $field 字段名
     * @param string $val 缓存值
     * @return mixed
     */
    static function redisHset ($key, $field, $val)
    {
        $redis = Redis::connection();
        $key = Common::cacheKey('', $key, static::class);
        $redis->hset($key, $field, $val);
        self::$redis_ini['exp'] && $redis->expire($key, self::$redis_ini['exp']*60);
    }



    static function redisHget ($key, $ext='')
    {
        $redis = Redis::connection();
        return $redis->hget(self::setKey($ext), $key);
    }


    /**
     * 删除缓存
     * @param mixed $key null表示删除整个缓存组，array或string为删除指定Key
     * @param string $ext
     */
    static function delCache ($key, $ext='')
    {
        $redis = Redis::connection();
        (isset($key))
            ? $redis->hdel(self::setKey($ext), (is_array($key) ? $key : [$key]) )
            : $redis->del([self::setKey($ext)]);
    }

}