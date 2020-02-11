<?php

namespace Hello;

include '../vendor/autoload.php';

interface test
{
	static function test ();
}


use Peak\Plugin\Cache\File;

$file = 'abc.json';
$obj = new File($file, 0777);
echo $obj->content();
exit;
if (!$res=$obj->content(456748974343312213)) {
    echo $obj->debug();
}



