<?php

namespace Peak\Plugin\Laravel\Cache\Redis;

trait Hash
{

    use Config;


    /**
     * 查看哈希表key中定的字段field是否存在
     * @param $key
     * @param $field
     * @return bool
     */
    static function redisHexists ($key, $field) :bool
    {
        $redis = self::redisCli($key);
        return (bool)$redis->hexists ($key, $field);
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
        $redis = self::redisCli($key);
        $redis->hset($key, $field, $val);
        self::$redisIni['exp'] && $redis->expire($key, self::$redisIni['exp']*60);
    }



    /**
     * 获取存储在哈希表Key中指定字段Field的值。
     * @param string|array $key 键名，如果是数组则将按照数组key顺序排序后组合成字符串
     * @param string $field 字段名
     */
    static function redisHget ($key, $field)
    {
        return self::redisCli($key)->hget($key, $field);
    }



    /**
     * 删除哈希表Key字段Field
     * @param string|array $key 键名，如果是数组则将按照数组key顺序排序后组合成字符串
     * @param string|array $field 要删除的字段 多个字段可并成数组
     * @return bool
     */
    static function redisHdel ($key, $field) :bool
    {
        $res = 0;
        $redis = self::redisCli($key);
        if (is_array($field)) {
            foreach ($field as &$val) {
                ($redis->hdel($key, $val)&&!$res) && $res=1;
            }
        } else {
            $res = $redis->hdel($key, $field);
        }
        return (bool)$res;
    }


    /**
     * 为哈希表 key 中的字段field的整数值加上增量 int （如果key.field不存在，将以0为初始值创建新缓存，再加上增量）
     * @param string|array $key 键名，如果是数组则将按照数组key顺序排序后组合成字符串
     * @param string $field 字段名
     * @param int $int 增加值
     * @return int 返回增加后的值
     */
    static function redisHincrby ($key, $field, $int)
    {
        return self::redisCli($key)->hincrby($key, $field, $int);
    }


    /**
     * 为哈希表 key 中的字段field的浮点值加上增量 float （如果key.field不存在，将以0为初始值创建新缓存，再加上增量）
     * @param string|array $key 键名，如果是数组则将按照数组key顺序排序后组合成字符串
     * @param string $field 字段名
     * @param float $float 增加值
     */
    static function redisHincrbyfloat ($key, $field, $float)
    {
        return self::redisCli($key)->hincrbyfloat($key, $field, $float);
    }


    /**
     * 同时将多个 field-value (域-值)对设置到哈希表 key 中。
     * @param string|array $key 键名，如果是数组则将按照数组key顺序排序后组合成字符串
     * @param array $dat field=>value 键值对形式
     */
    static function redisHmset ($key, array $dat)
    {
        $redis = self::redisCli($key);
        foreach ($dat as $field=>&$val) {
            $redis->hset($key, $field, $val);
        }
        self::$redisIni['exp'] && $redis->expire($key, self::$redisIni['exp']*60);
    }



    /**
     * 获取所有给定字段的值
     * @param string|array $key 键名，如果是数组则将按照数组key顺序排序后组合成字符串
     * @param array $field 字段数组
     */
    static function redisHmget ($key, array $field)
    {
        return self::redisCli($key)->hmget($key, $field);
    }



    /**
     * 获取在哈希表中指定 key 的所有字段和值
     * @param string|array $key 键名，如果是数组则将按照数组key顺序排序后组合成字符串
     */
    static function redisHgetall ($key)
    {
        return self::redisCli($key)->hgetall($key);
    }


    /**
     * 获取所有哈希表key中的字段
     * @param string|array $key 键名，如果是数组则将按照数组key顺序排序后组合成字符串
     */
    static function redisHkeys ($key)
    {
        return self::redisCli($key)->hkeys($key);
    }



    /**
     * 获取哈希表key中所有值
     * @param string|array $key 键名，如果是数组则将按照数组key顺序排序后组合成字符串
     */
    static function redisHvals ($key)
    {
        return self::redisCli($key)->hvals($key);
    }


    /**
     * 获取哈希表中字段的数量
     * @param string|array $key 键名，如果是数组则将按照数组key顺序排序后组合成字符串
     * @return int
     */
    static function redisHlen ($key)
    {
        return self::redisCli($key)->hlen($key);
    }



}
