<?php

namespace Hello;

include '../vendor/autoload.php';


class A
{

    private $error;

    public function error ($e=null)
    {
        if (isset($e)) {
            $this->error = $e;
        } else {
            return $this->error;
        }
    }
}


class B extends A{

}

$a = new B();
$a->error(666);

$b = new B();
echo $b->error();

