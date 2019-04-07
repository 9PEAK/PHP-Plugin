<?php

namespace Peak\Plugin\DB\SQL;

use Peak\Plugin\DB\Query;

trait Update
{


	static function update ($tb , array $dat=[]) {
		$sql = 'update '.$tb .' set ';
		$dat && $sql.=self::set($dat) ;
		return $sql;
	}




	/**
	 * 构造SET语句
	 * @param $dat array 需要设置参数 key=>val的形式
	 * @param $glue string 连接符
	 * @return string sql语句
	 * */
	static function set (array $dat, $glue='=')
	{
		if ($dat) {
			$n = Query::bind($dat);
			$dat = array_fill(0, $n, $glue.'?');
			$dat = join( ',' , $dat );
			return ' '.$dat.' ';
		}
	}



}