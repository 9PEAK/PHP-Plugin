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





	static function exec ($sql, array $param=[])
	{
		$sth = self::$pdo->prepare($sql);
//echo $sql,'<br>';
//print_r($param);
//exit;
		foreach ($param as $i=>$val ) {
			if (is_int($val)) {
				$type = \PDO::PARAM_INT;
			} elseif (is_null($val)) {
				$type = \PDO::PARAM_NULL;
			} else {
				$type = \PDO::PARAM_STR ;
			}
			$sth->bindValue($i+1, $val , $type) ;
		}


		if (!$sth->execute()) {
			// debug
		}

		return $sth;

	}



}
