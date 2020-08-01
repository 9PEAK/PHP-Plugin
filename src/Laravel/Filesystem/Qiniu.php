<?php

namespace Peak\Plugin\Laravel\Filesystem;

class Qiniu
{


    private static $qiniu;



    /*
     * 设置七牛Disk
     * @param string $disk 硬盘名
     * @return Filesystem
     */
    static function qiniuDisk ($disk='')
    {
        $disk && self::$qiniu=(string)$disk;
        return Storage::disk(self::$qiniu);
    }




    /**
     * 设置七牛文件完整路径
     * @param string $file
     * @return string
     */
    static function qiniuPath ($file)
    {
        return str_replace('\\', '/', static::class.'/'.$file);
    }


    /**
     * 获取七牛文件URL（包含完整路径）
     * @param string $file
     * @return string
     */
    static function qiniuUrl ($file)
    {
        $disk = self::qiniuDisk();
        $file = self::qiniuPath($file);
        return !$disk->exists($file) ? false : $disk->getUrl($file.'?t='.time());
    }


    /**
     * 读取七牛文件
     * @param string $file 文件名
     * @param bool $json 默认false返回原始格式 否则尝试将数据处理成Json后返回
     * @return false|string|Json
     */
    static function qiniuRead ($file, $json=false)
    {
        if ($file = self::qiniuUrl($file)) {
//            $file = self::qiniuDisk()->read(self::qiniuPath($file));
            $file = @file_get_contents($file);
            return $json ? json_decode($file) : $file;
        }
        return false;
    }



    /**
     * 存储七牛文件
     * @param string $file
     * @param mixed $dat
     * @return bool 是否存储成功
     */
    static function qiniuSave ($file, $dat) :bool
    {
        $disk = self::qiniuDisk();
        $file = self::qiniuPath($file);
        $dat = is_array($dat)||is_object($dat) ? json_encode($dat) : (string)$dat;
        for ($i=0; $i<3; $i++) {
            if ($disk->put($file, $dat)) return true;
        }
        return false;
    }

}
