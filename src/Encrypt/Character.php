<?php
namespace Peak\Plugin\Encrypt;
# 简单的字符处理
trait Character
{


    /**
     * 截断字符串 前后倒置连接 Move the string pointer by the given offset
     * @param $str. string. the letter or number
     * @param $x. int. offset for the pointer
     * @return string. the changed letter
     * */
    static function offset($str, $n)
    {
        return substr($str, $n).substr($str, 0, $n);
    }



    /**
     * 翻转字符串
     * @param $str string
     * */
    static function flip ($str)
    {
        $str = str_split($str);
        krsort($str);
        return join('', $str);
    }


}
