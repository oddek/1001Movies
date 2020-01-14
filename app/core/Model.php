<?php

class Model
{
	
	protected static $core;

	public function __construct()
	{
		//$this->core = new Core;
		//$this->db = $this->core->sql;
		if(self::$core == null)
		{
			self::$core = new Core;
		}
		//
	}
}

