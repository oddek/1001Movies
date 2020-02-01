<?php


//Main routing class which takes the URL and calls the proper controller and actionmethod
class Application
{
	protected $controller = 'homeController';
	protected $action = 'index';
	protected $prams = [];
	public $core;

	public function __construct() 
	{
		$this->core = new Core;

		$this->prepareURL();

		if(file_exists(CONTROLLER. $this->controller . '.php'))
		{
			$this->controller = new $this->controller;	
			if(method_exists($this->controller, $this->action))
			{
				call_user_func_array([$this->controller, $this->action], $this->prams);
			}
		}
	}

	protected function prepareURL()
	{
		$request = trim($_SERVER['REQUEST_URI'], '/');
		if(!empty($request))
		{
			$url = explode('/', $request);
			$this->controller = isset($url[0]) ? $url[0].'Controller' : 'homeController';
			$this->action = isset($url[1]) ? $url[1] : 'index';

			$this->action = (count($_POST) > 0) ? "post_".$this->action : $this->action;
			unset($url[0], $url[1]);
			$this->prams = !empty($url) ? array_values($url) : [];
		}
		if(!$this->core->isLoggedIn())
		{
			if($this->controller != 'loginController' && ($this->action != 'index' || $this->action != "post_index"))
			{
				header("Location: /login/index");
			}
		}
	}
}
?>