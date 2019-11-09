<?php

namespace Peak\Plugin\Cache;

use Illuminate\Support\Facades\Cache;

trait Laravel
{

    use Common;

	public static function set_cache ($dat, $id=null, $exp=60):bool
	{
		$id = self::key($id);
		$exp>0 ? Cache::put($id, $dat, $exp) : Cache::forever($id, $dat);
		return true;
	}



	public static function get_cache ($id)
	{
		return Cache::get(self::key($id));
	}



	public static function del_cache ($id=null)
	{
		Cache::forget($id);
//		return false;
	}


}
