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



	protected function get_content ()
	{

		if (!file_exists($this->file)) {
			return self::debug('缓存文件不存在，路径：“'.$this->file.'”。');
		}

		$res = file_get_contents($this->file);

		if ($res===false) {
			return self::debug('无法读取缓存文件，路径：“'.$this->file.'”。');
		}

		return $res;
	}



	protected function save_content ($dat)
	{

		$res = file_put_contents($this->file, is_string($dat) ? $dat : json_encode($dat));
		if ($res===false) {
			return self::debug('无法写入文件，路径：“'.$this->file.'”。');
		}

		if ($this->rwx) {
			if (!chmod($this->file, $this->rwx)) {
				return self::debug('无法设置文件权限，路径：“'.$this->file.'”。');
			}
		}

		return true;
	}


}
