<?php

namespace Peak\Plugin\Cache;

class JsonFile extends File
{


	protected function set_cache ($val, $key=null, $exp=60):bool
	{
		if ($key) {
			$dat = $this->get_cache();
			if ($dat!==false) {
				$dat ? $dat->$key=$val : $dat=[$key=>$val];
				return parent::set_cache(json_encode($dat));
			}
			return false;

		}

		return parent::set_cache(json_encode($val));
	}



	protected function get_cache ($key=null)
	{
		$dat = parent::get_cache();
		if ($dat!==false) {
			$dat = $dat ? json_decode($dat) : null;
			$dat&&$key && $dat= is_array($dat) ? @$dat[$key] : @$dat->$key;
		}
		return $dat;
	}



	protected function del_cache ($key=null):bool
	{
		if ($key) {
			$dat = $this->get_cache();
			if ($dat) {
				unset ($dat->$key);
			}
		} else {
			$dat = [];
		}
		return $this->set_cache($dat);
	}




	/**
	 * 设置|获取缓存文件
	 * @param $key string 缓存键名
	 * @param $val mixed 缓存键值，值为时，表示获取缓存，否则表示设置缓存，当$key为空时，覆盖所有缓存数据，否则只更新指定的缓存数据
	 * */
	public function content ($key=null, $val=null)
	{
		return $val ? $this->set_cache($val, $key) : $this->get_cache($key);
	}


}
