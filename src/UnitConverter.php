<?php
/**
 * 单位转换计算器
 * @author Kane
 */

namespace Peak\Plugin;

class UnitConverter
{

    const UNIT = [
        # 重量单位
        'kg' => '千克/公斤',
        'lb' => '磅',
        'lbs' => '磅',
        # 长度单位
        'inch' => '寸/英寸',
        'inches' => '寸/英寸',
        'cm' => '厘米/公分',
        'foot' => '尺/英尺',
        'feet' => '尺/英尺',
    ];


    # 格式：a/b => 商
    const RATE = [
        'lb/kg' => 2.2046,
        'lbs/kg' => 2.2046,
        'cm/inch' => 2.54,
        'cm/inches' => 2.54,
    ];


    /**
     * 计算
     * @param float $val
     * @param string $from 初始单位
     * @param string $to 转化单位
     * @param int $prec 精度，默认2精确到小数点后两位
     * @return float|false 如遇到无法计算的单位返回false
     */
    static function translate ($val, $from, $to, $prec=2)
    {
        $from = strtolower($from);
        $to = strtolower($to);

        // 保证单位是支持的
        if (@self::UNIT[$from] && @self::UNIT[$to]) {
            if ($rate = @self::RATE[$from . '/' . $to]) {
                return round($val / $rate, $prec);
            } else if ($rate = @self::RATE[$to . '/' . $from]) {
                return round($rate * $val, $prec);
            }
        }
        return false;
    }

}
