<?php

include '../src/Debuger/Standard.php';

class test
{
	use \Peak\Plugin\Debuger\Standard;

}

$obj = new test();

try {
	$obj->setDebug('666');
} catch (\Exception $e) {
	echo $e->getMessage();
}

echo $obj->getDebugMsg();



