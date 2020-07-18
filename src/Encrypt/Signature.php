<?php

namespace Peak\Plugin\Encrypt;
/**
 * 签名组件
 */
class Signature
{

    private static $config = [
        'kv' => '=',
        'nan' => false,
        'asc' => true,
        'glue' => '&',
    ];

    /**
     * 配置
     * @param string $kv 参数键值链接符
     * @param bool $nan 是否过滤空字符串参数
     * @param bool $aes 参数排序顺序 默认true按照键名顺序 否则倒序
     * @param string $glue 连接字符串
     * @return self
     */
    static function config ($kv='=', $nan=false, $asc=true, $glue='&')
    {
        self::$config = [
            'kv' => (string)$kv,
            'nan' => (bool)$nan,
            'asc' => (bool)$asc,
            'glue' => (string)$glue,
        ];
        return self::class;
    }



    private static $param = [];

    /**
     * 设置参数
     * @param string|array $key 如果是数组则必须为二维数组 否则加密数据将有问题
     * @param string $val 如果$key参数为数组则该参数将被忽略
     * @return self
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
     * @param bool $init 重置清空$param
     * @return self
     */
    static function reset ($init=false)
    {
        if ($init ) {
            self::$param = [];
        } else {
            self::$config['asc'] ? ksort(self::$param) : krsort(self::$param);
            foreach (self::$param as $k=>&$v) {
                if (self::$config['nan']) {
                    if (!strlen($v)) {
                        unset(self::$param[$k]);
                        continue;
                    }
                }
                $v = $k.'='.$v;
            }
            self::$param = join(self::$config['glue'], self::$param);
        }

        return self::class;
    }


    /**
     * md5 签名
     * @param string $ext 签名后缀
     * @return string
     */
    static function md5 ($ext='')
    {
        is_array(self::$param) && self::reset();
        return md5(self::$param.$ext);
    }

    /**
     * sha1 签名
     * @param string $ext 签名后缀
     * @return string
     */
    static function sha1 ($ext='')
    {
        is_array(self::$param) && self::reset();
        return sha1(self::$param.$ext);
    }

}
