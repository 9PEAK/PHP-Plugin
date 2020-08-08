<?php

namespace Peak\Laravel\Cache;

use Illuminate\Support\Facades\Cache;

trait Common
{

    /**
     * 设置缓存KEY
     * @param string $id 缓存KEY
     * @param string $pref KEY前缀 默认空不使用
     * @param string $ext KEY后缀 默认空不使用
     * @return string
     */
	static function key ($id, $pref='', $ext='')
	{
	    $id = [$id];
	    $pref && array_unshift($id, $pref);
	    $ext && array_push($id, $ext);
        array_unshift($id, self::class);
		return join(':', $id);
	}


	/**
	 * 删除、设置、获取缓存
	 * @param $id string 键名
	 * @param $dat mixed 键值 null表示获取，否则表示设置。
	 * @param $exp int 存储时间（分钟）：<0，删除缓存；0，永久存储；>0，缓存有效期。
	 * */
	static function cache ($id, $dat=null, $exp=60)
	{
		$id = self::key($id);

		// 删除
		if ($exp<0) {
			return Cache::forget($id);
		}

		// 存储
		if (isset($dat)) {
			return  $exp ? Cache::put($id, $dat, $exp*60) : Cache::forever($id, $dat);
		}

		// 获取
		return Cache::get($id);
	}


    /**
     * 设置缓存
     */
	static function iniCache ()
    {

    }


    /**
     * 删除缓存
     * @param string $key 键名主要值
     * @param string|array $ext 键名后缀，多个后缀以数组形式传入
     */
	static function getCache ($key, $ext='')
    {

    }


    /**
     * 删除缓存
     * @param string $key 键名主要值
     * @param string|array $ext 键名后缀，多个后缀以数组形式传入
     */
    static function setCache ($key, $dat, $ext='')
    {

    }


    /**
     * 删除缓存
     * @param string $key 键名主要值
     * @param string|array $ext 键名后缀，多个后缀以数组形式传入
     */
    static function delCache ($key, $ext='')
    {


    }


}

/**
 * 设置缓存KEY
 * @param string $key
 * @param string|array $ext 如果是数组则将按照数组key顺序排序后组合成字符串
 */
function cache_key (&$key, &$ext, &$pref)
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
    return join(':', $key);
}
