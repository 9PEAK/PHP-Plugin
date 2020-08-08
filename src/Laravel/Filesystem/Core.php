<?php

namespace Peak\Plugin\Laravel\Filesystem;

trait Core
{


    private static $disk;



    /*
     * 设置七牛Disk
     * @param string $disk 硬盘名
     * @return Filesystem
     */
    static function fileDisk ($disk='')
    {
        $disk && self::$disk=(string)$disk;
        return \Illuminate\Support\Facades\Storage::disk(self::$disk);
    }




    /**
     * 设置七牛文件完整路径
     * @param string $file
     * @return string
     */
    static function filePath ($file)
    {
        return str_replace('\\', '/', static::class.'/'.$file);
    }


    /**
     * 获取七牛文件URL（包含完整路径）
     * @param string $file
     * @return string|false 当Disk不支持URL时返回false 否则返回文件的URL字符串 如果文件不存在则返回空字符串
     */
    static function fileUrl ($file)
    {
        $disk = self::fileDisk();
        if (!method_exists($disk, 'getUrl')) return false;
        $file = self::filePath($file);
        return $disk->exists($file) ? $disk->getUrl($file.'?t='.time()) : '';
    }


    /**
     * 读取七牛文件
     * @param string $file 文件名
     * @param bool $json 默认false返回原始格式 否则尝试将数据处理成Json后返回
     * @return false|string|Json
     */
    static function fileRead ($file, $json=false)
    {
        if ($file = self::fileUrl($file)) {
//            $file = self::fileDisk()->read(self::filePath($file));
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
    static function fileSave ($file, $dat) :bool
    {
        $disk = self::fileDisk();
        $file = self::filePath($file);
        $dat = is_array($dat)||is_object($dat) ? json_encode($dat) : (string)$dat;
        for ($i=0; $i<3; $i++) {
            if ($disk->put($file, $dat)) return true;
        }
        return false;
    }

}
