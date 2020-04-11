<?php

namespace Hello;

include '../vendor/autoload.php';

interface test
{
	static function test ();
}


use Peak\Plugin\Cache\File;

$file = 'abc.json';
$obj = new File($file, 0666);
//echo $obj->content();
//exit;
if (!$res=$obj->content(7489789)) {
    echo $obj->debug();
}


use Peak\Plugin\Cache\JsonFile;



