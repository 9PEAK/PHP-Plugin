<?php

namespace Peak\Plugin\Cache;

class File
{

	use Common;
	use \Peak\Plugin\Debuger;

	protected $file, $rwx;

	/**
	 * @param string $file 文件存储路径
	 * @param int $rwx 权限
	 */
	function __construct($file, $rwx=0660)
	{
		$this->file = $file;
		$this->rwx = $rwx;
	}



	protected function set ($dat)
	{

		if (file_put_contents($this->file, (string)$dat)===false) {
			return self::debug('无法写入文件，路径：“'.$this->file.'”。');
		}

		if ($this->rwx) {
			if (!chmod($this->file, $this->rwx)) {
				return self::debug('无法设置文件权限，路径：“'.$this->file.'”。');
			}
		}

		return true;
	}


	
	protected function get ()
	{
		if (!file_exists($this->file)) {
			return (bool)self::debug('缓存文件不存在，路径：“'.$this->file.'”。');
		}

		$res = file_get_contents($this->file);

		if ($res===false) {
			return self::debug('无法读取缓存文件，路径：“'.$this->file.'”。');
		}

		return $res;
	}



	/**
	 * 设置|获取缓存文件
	 * @param string|null $dat 默认null表示获取缓存数据，否则表示设置缓存
	 * */
	public function content ($dat=null)
	{
		return $dat ? $this->set($dat) : $this->get();
	}

}
