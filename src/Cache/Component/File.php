<?php

namespace Peak\Plugin\Cache;

class File extends Core
{

	protected $file, $rwx;

	function __construct($file, $rws=0660)
	{
		$this->file = $file;
		$this->rwx = $rws;
	}



	protected function set_cache ($dat, $id=null, $exp=60):bool
	{

		if (!is_string($dat)) {
			return self::debug('传入的数据格式字符串型。');
		}

		if (file_put_contents($this->file, $dat)===false) {
			return self::debug('无法写入文件，路径：“'.$this->file.'”。');
		}

		if ($this->rwx) {
			if (!chmod($this->file, $this->rwx)) {
				return self::debug('无法设置文件权限，路径：“'.$this->file.'”。');
			}
		}

		return true;
	}


	protected function get_cache ($id=null)
	{
		if (!file_exists($this->file)) {
			return (bool)self::debug('缓存文件不存在，路径：“'.$this->file.'”。');
		}

		$res = file_get_contents($this->file);

		if ($res===false) {
			return (bool)self::debug('无法读取缓存文件，路径：“'.$this->file.'”。');
		}

		return $res;
	}



	protected function del_cache ($id=null):bool
	{
		return $this->set_cache('');
	}




	/**
	 * 设置|获取缓存文件
	 * */
	public function content ($dat=null)
	{
		return $dat ? $this->set_cache($dat) : $this->get_cache();
	}





}
