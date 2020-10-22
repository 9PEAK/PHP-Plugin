<?php
/**
 * 单位转换计算器
 * @author Kane
 */

namespace Peak\UnitConverter {

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

}


namespace {

    use Peak\UnitConverter as Peak;

    /**
     * 转化计量单位
     * @param float $val
     * @param string $from 初始单位
     * @param string $to 转化单位
     * @param int $prec 精度，默认2精确到小数点后两位
     * @return float|false 如遇到无法计算的单位返回false
     */
    function convert_measurement ($val, $from, $to, $prec=2)
    {
        // 保证单位是支持的
        $from = strtolower($from);
        $to = strtolower($to);

        if (@Peak\UNIT[$from] && @Peak\UNIT[$to]) {
            if ($rate = @Peak\RATE[$from . '/' . $to]) {
                return round($val / $rate, $prec);
            } else if ($rate = @Peak\RATE[$to . '/' . $from]) {
                return round($rate * $val, $prec);
            }
        }

        return false;
    }

}
