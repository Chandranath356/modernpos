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
final class Registry 
{
	private $data = array();

	public function get($key) 
	{
		return (isset($this->data[$key]) ? $this->data[$key] : null);
	}

	public function set($key, $value) 
	{
		$this->data[$key] = $value;
	}

	public function has($key) 
	{
		return isset($this->data[$key]);
	}
}