<?php

namespace Peak\Plugin\DB;

trait Connection {


	/**
	 * 数据库连接
	 * @param $db string 数据库名
	 * @param $usr string 数据库用户名
	 * @param $pwd string 数据库密码
	 * @param $host string 主机
	 * @param $port int 链接端口
	 * @return mixed \PDO
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
