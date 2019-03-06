<?php

namespace Peak\Plugin\Encrypt;

class CaeserCode {

    protected $from;
    protected $to;

    function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }


    /**
     * 字符串转化
     * @param $str string 需要转化的字符串
     * @param $from string 字母对照正表
     * @param $to string 字母对照反表
     * @return string
     * */
    protected static function convert ($str, $from, $to)
    {
        $max = strlen($str);
        for ($i=0; $i<$max; $i++) {
            $x = strpos($from, $str[$i]);
            $str[$i] = $x===false ? $str[$i] : $to[$x];
        }
        return $str;
    }


    public function encode ($str)
    {
        return self::convert($str, $this->from, $this->to);
    }


    public function decode ($str)
    {
        return self::convert($str, $this->to, $this->from);
    }



}