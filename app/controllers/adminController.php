<?php

class adminController extends Controller
{

	public function index($id = '', $name= '')
	{

		$this->view('admin' . DIRECTORY_SEPARATOR . 'index', 
		[
			'name' => $name,
			'id' => $id
		]);
		$this->view->page_title = 'Home';
		$this->view->render();
	}


	public function viewUsers($name= '')
	{
		$this->model('UserRepository');
		#$this->model->load_all_users();
		$this->view('admin' . DIRECTORY_SEPARATOR . 'viewUsers', $this->model->get_users());
		$this->view->page_title = 'All Users';
		$this->view->render();
	}
}
?>