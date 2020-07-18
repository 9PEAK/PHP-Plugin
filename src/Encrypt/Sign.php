<?php

namespace Peak\Plugin\Encrypt;

class Sign
{


    private static $param;

    /**
     * 设置参数
     * @param string|array $key
     * @param string $val 如果$key参数为数组则该参数将被忽略
     */
    static function param ($key, $val='')
    {
        if (is_array($key)) {
            foreach ($key as $k=>$v) {
                self::{__FUNCTION__}($k, (string)$v);
            }
        } else {
            self::$param[$key] = (string)$val;
        }

        return self::class;
    }


    /**
     * 将参数设置成字符串
     * @param bool $nan 是否过滤空字符串参数
     * @param bool $aes 参数排序顺序 默认true按照键名顺序 否则倒序
     * @param string $glue 连接字符串
     * @return mixed
     */
    private static function reset ($nan, $aes, $glue)
    {
        $aes ? ksort(self::$param) : krsort(self::$param);
        foreach (self::$param as $k=>&$v) {
            if ($nan) {
                if (!strlen($v)) {
                    unset(self::$param[$k]);
                    continue;
                }
            }
            $v = $k.'='.$v;
        }

        return join((string)$glue, self::$param);
    }



    static function md5 ($nan=false, $aes=true, $glue='&')
    {
        $param = self::reset($nan, $aes, $glue);
    }



}
