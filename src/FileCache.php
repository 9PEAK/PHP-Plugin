<?php

namespace Peak\Plugin;

class FileCache {

	private $file, $rwx;

	function __construct($file, $rws=0660)
	{
		$this->file = $file;
		$this->rwx = $rws;
	}

	use Debuger\Base;


	/**
	 * 设置|获取缓存文件
	 * */
	public function content ($dat=null)
	{
		return $dat ? self::save_content($dat) : $this->get_content();
	}



	/**
	 * 读取文件
	 * @return string|false|null 成功读取文件，返回string；读取失败，返回false；文件不存在，返回null。
	 * */
	protected function get_content ()
	{

		if (!file_exists($this->file)) {
			self::debug('缓存文件不存在，路径：“'.$this->file.'”。');
			return null;
		}

		$res = @file_get_contents($this->file);
		if ($res===false) {
			self::debug('无法读取缓存文件，路径：“'.$this->file.'”。');
		}

		return $res;
	}



	/**
	 * 存储文件
	 * @param $dat mixed 要存储的数据，string,int,object,array，其中object和array类型的数据将最终转化成json存储。
	 * @param $mode bool 是否设置文件权限
	 * @return bool
	 * */
	protected function save_content ($dat, $mode=false)
	{

		if (!file_exists($this->file)) {
			// 尝试创建文件
			if (!$this->save_content('', true)) {
				return false;
			}
		}

		$res = file_put_contents($this->file, is_string($dat) ? $dat : json_encode($dat));
		if ($res===false) {
			return self::debug('无法写入文件，路径：“'.$this->file.'”。');
		}

		if ($mode) {
			if (@!chmod($this->file, $this->rwx)) {
				return self::debug('无法设置文件权限，路径：“'.$this->file.'”。');
			}
		}

		return true;
	}


}
