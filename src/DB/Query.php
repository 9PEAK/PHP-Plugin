<?php

namespace Peak\Plugin\DB;

trait Query
{

	protected static $pdo;

	static function pdo (\PDO $pdo=null)
	{
		if ($pdo) {
			self::$pdo = $pdo;
		} else {
			return self::$pdo;
		}
	}


//	private static $param = [];

	/**
	 * 设置绑定查询参数
	 * @param $dat string 加入查询的变量 默认为空 清空查询值
	 * @return int 加入变量的总数。
	 * */
	static function setParam (array &$all, array $param=[])
	{
		$n = count($all);
		foreach ($param as $k=>$v) {
			is_array($v) ? self::{__FUNCTION__}($all, $v) : $all[]=$v;
		}
		$param || $all=[];

		$n = count($all)-$n;
		return $n>0 ? $n : 0;
	}



	static function exec ($sql, array $param=[])
	{
		$sth = self::$pdo->prepare($sql);

		foreach ( $param as $i=>$val ) {
			if (is_int($val)) {
				$type =& \PDO::PARAM_INT;
			} elseif (is_null($val)) {
				$type =& \PDO::PARAM_NULL;
			} else {
				$type =& \PDO::PARAM_STR ;
			}
			$sth->bindValue($i+1, $val , $type) ;
		}


		if (!$sth->execute()) {
			// debug
		}

		return $sth;

	}



}
