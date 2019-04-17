<?php

namespace Peak\Plugin\Cache;

use Illuminate\Support\Facades\Cache;

trait Laravel
{


	protected function set_cache ($dat, $id=null, $exp=60):bool
	{
		$id = self::key($id);
		$exp>0 ? Cache::put($id, $dat, $exp) : Cache::forever($id, $dat);
		return true;
	}



	protected function get_cache ($id=null)
	{
		return Cache::get(self::key($id));
	}



	protected function del_cache ($id=null):bool
	{
		Cache::forget($id);
		return false;
	}


}
