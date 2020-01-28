<?php
/**
 * 缓存模式
 * */
namespace Peak\Plugin\Cache;

interface Core
{
	/**
	 * 设置缓存
	 * @param string $key 键名
	 * @param mixed $dat 数据
	 * @param int $exp 缓存时间
	 * @return bool
	 */
	static function cacheSet ($key, $dat, $exp=60):bool;


	/**
	 * 获取缓存
	 * @param string $key 键名
	 * @return bool
	 */
	static function cacheGet ($key);


	/**
	 * 删除缓存
	 * @param string $key 键名
	 * @return bool
	 */
	static function cacheDel ($key):bool;

}
