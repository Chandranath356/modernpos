<?php
/*
| -----------------------------------------------------
| PRODUCT NAME: 	MODERN POS
| -----------------------------------------------------
| AUTHOR:			GITLanka.COM
| -----------------------------------------------------
| EMAIL:			info@GITLanka.com
| -----------------------------------------------------
| COPYRIGHT:		RESERVED BY GITLanka.COM
| -----------------------------------------------------
| WEBSITE:			http://GITLanka.com
| -----------------------------------------------------
*/
abstract class Model 
{
	protected $registry;
	protected $hooks;

	public function __construct($registry) 
	{
		$this->registry = $registry;
		$this->hooks = registry()->get('hooks');
	}

	public function __get($key) 
	{
		return $this->registry->get($key);
	}

	public function __set($key, $value) 
	{
		$this->registry->set($key, $value);
	}
}