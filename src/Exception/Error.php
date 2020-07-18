<?php

namespace Peak\Plugin\Exception;

trait Error
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
