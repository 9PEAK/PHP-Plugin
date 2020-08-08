<?php

namespace Peak\Plugin\Laravel\Cache;

use Illuminate\Support\Facades\Cache;

trait Config
{

    private static $cache_ini = [
        'exp' =>60, // 60分钟
        'type' => 'redis',
    ];


    /**
     * 设置缓存
     * @param int $exp 缓存时间 默认60分钟
     * @param string $type 缓存类型 默认reids
     */
    static function cacheIni ($exp, $type)
    {
        self::$cache_ini = [
            'exp' => $exp,
            'type' => $type,
        ];
    }



    /**
     * 设置缓存KEY
     * @param string $key 主Key
     * @param string|array $ext Key后缀 如果是数组则将按照数组key顺序排序后组合成字符串
     * @param string $pref Key前缀
     * @param string
     */
    static function cacheKey ($key, $ext, $pref)
    {
        $key = [
            $pref,
            $key
        ];
        if ($ext) {
            if (is_array($ext)) {
                ksort($ext);
                foreach ($ext as $k=>&$v) {
                    $v = $k.'='.$v;
                }
                $ext = join('&', $ext);
            }
            $key[] = $ext;
        }
        $key = join(':', $key);
        return $key;
    }


}
