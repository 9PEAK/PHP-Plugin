<?php

namespace Peak\Plugin\Cache;

class JsonFile extends File
{

	protected $mode;

	/**
	 * @param string $file 文件存储路径
	 * @param int $rwx 权限
	 * @param bool $toArray 默认false，以json对象返回结果，否则全部以数组形式返回
	 */
	function __construct($file, $rwx, $toArray=false)
	{
		parent::__construct($file, $rwx);
		$this->mode = (bool)$toArray;
	}


	/**
	 * 设置
	 * @param string $key 获取key
	 * @return mixed
	 */
	protected function get($key)
	{
		$dat = parent::get();
		$dat = json_decode($dat ?: ($this->mode ? '[]' : '{}'), $this->mode );
		return $this->mode ? @$dat[$key] : @$dat->$key;
	}


	/**
	 * 获取
	 * @param string $key
	 * @param mixed $val
	 * @return bool
	 */
	protected function set ($key, $val):bool
	{
		$dat = $this->get($key);
		$this->mode ? $dat[$key]=$val : $dat->$key=$val;
		return parent::set(json_encode($dat));
	}


	/**
	 * 设置|获取数据
	 * @param string $key
	 * @param string|null $dat 默认null表示获取数据，否则表示设置数据
	 * */
	public function content ($key, $dat=null)
	{
		if (!$key||!is_string($key)) return self::debug('Key不可谓空且必须是字符。');

		if (isset($dat)) {
			$this->set($key, $dat);
		} else {
			return $this->get($key);
		}
	}


/*
	public function cacheSet ($val, $key=null, $exp=60):bool
	{
		if ($key) {
			$dat = $this->cacheGet();
			if ($dat!==false) {
				$dat ? $dat->$key=$val : $dat=[$key=>$val];
				return parent::cacheSet(json_encode($dat));
			}
			return false;

		}

		return parent::cacheSet(json_encode($val));
	}



	static function cacheGet ($key=null)
	{
		$dat = parent::cacheGet();
		if ($dat!==false) {
			$dat = $dat ? json_decode($dat) : null;
			$dat&&$key && $dat= is_array($dat) ? @$dat[$key] : @$dat->$key;
		}
		return $dat;
	}



	static function cacheDel ($key=null):bool
	{
		if ($key) {
			$dat = $this->cacheGet();
			if ($dat) {
				unset ($dat->$key);
			}
		} else {
			$dat = [];
		}
		return $this->cacheSet($dat);
	}
*/


}
