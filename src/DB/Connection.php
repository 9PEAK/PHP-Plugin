<?php

namespace Peak\Plugin\DB;

trait Connection {


	/** 数据库连接
	 * @param
	 * $db ： 数据库名
	 * $usr : 数据库用户名
	 * $pwd : 数据库密码
	 * $host : 主机
	 * $port : 链接端口
	 */
	static function handle ($type, $db , $usr=null , $pwd=null , $host='localhost' , $port=null)
	{
		switch ($type ) {
			case 'pgsql' :
				return self::postgress($db , $usr , $pwd , $host , $port);

			case 'mysql' :
				return self::mysql($db , $usr , $pwd , $host , $port);

			case 'sqlite' :
				return self::sqlite($db, 3);
		}

		// 数据库类型不支持
	}


	protected static function postgress ($db , $usr , $pwd , $host , $port)
	{
		$port = $port ? ';port='.$port : '' ;
		return new \PDO('pgsql:host='.$host.';dbname='.$db.$port , $usr , $pwd );
	}


	protected static function mysql ($db , $usr , $pwd , $host , $port)
	{
		$port = $port ? ';port='.$port : '' ;
		return new \PDO('mysql:host='.$host.';dbname='.$db.$port , $usr , $pwd);
	}



	protected static function sqlite ($db, $version=3)
	{
		if ($version) {
			try{
				return new \PDO('sqlite'.$version.':'.$db);
			} catch (\PDOException $e) {
				return self::{__FUNCTION__}($db, --$version);
			}
		}

		// 无法连接数据库

	}




}
