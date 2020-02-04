<?php
//Model base class. Not really necessery for anything else than holding an instance of Core class.
class Model
{
	protected static $core;
	public function __construct()
	{
		if(self::$core == null)
		{
			self::$core = new Core;
		}
	}
}

