<?php

namespace Peak\Plugin\Eloquent;

use Peak\Plugin\SQL as Query;

trait Sql
{

	/**
	 * 追加至查询语句 Laravel
	 * @param $query
	 * @param $key array
	 * @param $eccept array
	 * @param $prf string
	 * @param $ext string
	 * @return $query
	 * */
	public function scopeSelectPropertyForLaravel ($query, array $key, array $eccept=[], $prf='_', $ext='')
	{
		$query->addSelect(\DB::raw(
			static::sqlOfSelectProperties($key, $eccept, $prf, $ext)
		));
		return $query;
	}



	/**
	 * SQL查询获取配置的Property的查询语句
	 * @param $property array 需要查询的参数，一维数组
	 * @param $eccept array 不需要查询的、排除在外的参数，一维数组
	 * */
	public static function sqlOfSelectProperties (array $key=[], array $eccept=[], $prf='_', $ext='')
	{
		// 取交集
		$key = $key ? array_intersect_key(static::translation(), array_flip($key)) : static::translation();
		// 取差集
		$eccept && $key=array_diff_key($key, array_flip($eccept));

		foreach ($key as $k=>&$v) {
			$v = Query\Select::caseThenOfSimple($k, $v, $prf.$key.$ext);
		}
		return $key ? join (',', $key) : '';
	}


}
