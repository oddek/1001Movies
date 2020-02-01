<?php
//Controller Base Class.
//All other controllers inherit from this one.
class Controller
{
	protected $core;
	protected $view;
	protected $model;

	public function __construct()
	{
		$this->core = new Core;
	}

	public function view($viewName, $data = [])
	{
		$this->view = new View($viewName, $data);
		return $this->view;
	}

	public function model($modelName, $data=[])
	{
		if(file_exists(MODEL . DIRECTORY_SEPARATOR . $modelName . '.php'));
		require_once(MODEL . DIRECTORY_SEPARATOR . $modelName . '.php');
		$this->model = new $modelName;
	}

	public function redirect($url)
	{
		header("location: {$url}");
	}
}
?>