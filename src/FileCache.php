<?php

namespace Peak\Plugin;

class FileCache {

	private $file, $rwx;

	function __construct($file, $rws=0660)
	{
		$this->file = $file;
		$this->rwx = $rws;
	}

	use Debuger;


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
			return self::debug('缓存文件“'.$this->file.'”不存在。');
		}

		$res = file_get_contents($this->file);

		if ($res===false) {
			return self::debug('无法读取缓存文件。');
		}

		return $res;
	}



	protected function save_content ($dat)
	{

		$res = file_put_contents($this->file, is_string($dat) ? $dat : json_encode($dat));
		if ($res===false) {
			return self::debug('无法写入文件。');
		}

		if ($this->rwx) {
			if (!chmod($this->file, $this->rwx)) {
				return self::debug('无法设置文件权限。');
			}
		}

		return true;
	}


}
