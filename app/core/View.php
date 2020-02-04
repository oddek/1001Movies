<?php
//Baseclass for all views.
class View
{
	protected $view_file;
	protected $view_data;

	public function __construct($view_file, $view_data)
	{
		$this->view_file = $view_file;
		$this->view_data = $view_data;
	}

	public function render()
	{
		if(file_exists(VIEW . $this->view_file . '.php'))
		{
			include VIEW . $this->view_file . '.php';
		}
	}

	public function getAction()
	{
		$parts = (explode('\\', $this->view_file));
		if(isset($parts[1])){ return $parts[1];}
		else return '';
	}
}
?>