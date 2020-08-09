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




    static function redisHexists ($key, $field, $ext='')
    {
//        $redis = Redis::connection();
//        $key = Common::cacheKey('', $key, static::class);
        $redis = self::redis_cli($key);
        $redis->hexists ($key, $field);
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
//        $redis = Redis::connection();
//        $key = Common::cacheKey('', $key, static::class);
        $redis = self::redis_cli($key);
        $redis->hset($key, $field, $val);
        self::$redis_ini['exp'] && $redis->expire($key, self::$redis_ini['exp']*60);
    }



    /**
     * 获取存储在哈希表Key中指定字段Field的值。
     * @param string|array $key 键名，如果是数组则将按照数组key顺序排序后组合成字符串
     * @param string $field 字段名
     */
    static function redisHget ($key, $field)
    {
//        $redis = Redis::connection();
//        $key = Common::cacheKey('', $key, static::class);
        $redis = self::redis_cli($key);
        return $redis->hget($key, $field);
    }



    /**
     * 删除哈希表Key字段Field
     * @param string|array $key 键名，如果是数组则将按照数组key顺序排序后组合成字符串
     * @param string|array $field 要删除的字段 多个字段可并成数组
     */
    static function redisHdel ($key, $field)
    {

//        $redis = Redis::connection();
//        $key = Common::cacheKey('', $key, static::class);
        $redis = self::redis_cli($key);
        if (is_array($field)) {
            foreach ($field as &$val) {
                $redis->hdel($key, $val);
            }
        } else {
            $redis->hdel($key, $field);
        }
    }


    /**
     * 为哈希表 key 中的字段field的整数值加上增量 int
     * @param string|array $key 键名，如果是数组则将按照数组key顺序排序后组合成字符串
     * @param string $field 字段名
     * @param int $int 增加值
     */
    static function redisHincrby ($key, $field, $int)
    {
//        $redis = Redis::connection();
//        $key = Common::cacheKey('', $key, static::class);
        $redis = self::redis_cli($key);
        $redis->hincrby($key, $field, $int);
    }


    /**
     * 为哈希表 key 中的字段field的浮点值加上增量 float
     * @param string|array $key 键名，如果是数组则将按照数组key顺序排序后组合成字符串
     * @param string $field 字段名
     * @param float $float 增加值
     */
    static function redisHincrbyfloat ($key, $field, $float)
    {
//        $redis = Redis::connection();
//        $key = Common::cacheKey('', $key, static::class);
        $redis = self::redis_cli($key);
        $redis->hincrbyfloat($key, $field, $float);
    }


    /**
     * 同时将多个 field-value (域-值)对设置到哈希表 key 中。
     * @param string|array $key 键名，如果是数组则将按照数组key顺序排序后组合成字符串
     * @param array $dat field=>value 键值对形式
     */
    static function redisHmset ($key, array $dat)
    {
        $redis = self::redis_cli($key);
        foreach ($dat as $field=>&$val) {
            $redis->hset($key, $field, $val);
        }
        self::$redis_ini['exp'] && $redis->expire($key, self::$redis_ini['exp']*60);
    }



    /**
     * 获取所有给定字段的值
     * @param string|array $key 键名，如果是数组则将按照数组key顺序排序后组合成字符串
     * @param array $field 字段数组
     */
    static function redisHmget ($key, array $field)
    {
        $redis = self::redis_cli($key);
        return $redis->hmget($key, $field);
    }



    /**
     * 获取在哈希表中指定 key 的所有字段和值
     * @param string|array $key 键名，如果是数组则将按照数组key顺序排序后组合成字符串
     */
    static function redisHgetall ($key)
    {
        $redis = self::redis_cli($key);
        return $redis->hgetall($key);
    }


    /**
     * 获取所有哈希表key中的字段
     * @param string|array $key 键名，如果是数组则将按照数组key顺序排序后组合成字符串
     */
    static function redisHkeys ($key)
    {
        $redis = self::redis_cli($key);
        return $redis->hkeys($key);
    }



    /**
     * 获取哈希表key中所有值
     * @param string|array $key 键名，如果是数组则将按照数组key顺序排序后组合成字符串
     */
    static function redisHvals ($key)
    {
        $redis = self::redis_cli($key);
        return $redis->hvals($key);
    }


    /**
     * 获取哈希表中字段的数量
     * @param string|array $key 键名，如果是数组则将按照数组key顺序排序后组合成字符串
     * @return int
     */
    static function redisHlen ($key)
    {
        $redis = self::redis_cli($key);
        return $redis->hlen($key);
    }



}
