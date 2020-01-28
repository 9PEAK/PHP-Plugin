<?php

namespace Peak\Plugin\Cache;

class JsonFile extends File
{


	static function cacheSet ($val, $key=null, $exp=60):bool
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



}
