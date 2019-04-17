<?php
/**
 * 缓存模式
 * */
namespace Peak\Plugin\Cache;

abstract class Core
{

	use \Peak\Plugin\Debuger\Base;

	use Key;

	abstract protected function set_cache ($dat, $id=null, $exp=60):bool;
	abstract protected function get_cache ($id=null);
	abstract protected function del_cache ($id=null):bool;


}