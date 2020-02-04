<?php
class homeController extends Controller
{
	//The HomePage
	public function index($id = '', $name= '')
	{
		$this->view('home' . DIRECTORY_SEPARATOR . 'index', 
		[
			'name' => $name,
			'id' => $id
		]);
		$this->view->page_title = 'Home';
		$this->view->render();
	}

	//About Page
	public function aboutUs($id = '', $name= '')
	{
		$this->view('home' . DIRECTORY_SEPARATOR . 'aboutUs', 
		[
			'name' => $name,
			'id' => $id
		]);
		$this->view->page_title = 'About';
		$this->view->render();
	}

	//Progress Page
	public function progress($id = '', $name= '')
	{
		$this->model('Progress');
		$this->view('home' . DIRECTORY_SEPARATOR . 'progress', $this->model);
		$this->view->page_title = 'Progress';
		$this->view->render();
	}

	//Profile Page: Not implemented yet
	public function profile($id = '', $name= '')
	{
		$this->view('home' . DIRECTORY_SEPARATOR . 'profile', 
		[
			'name' => $name,
			'id' => $id
		]);
		$this->view->page_title = 'Profile';
		$this->view->render();
	}

	//Show all movies page
	public function movies($id = '', $name='')
	{
		/*$this->view('home' . DIRECTORY_SEPARATOR . 'movies', 
		[
			'name' => $name,
			'id' => $id
		]);*/
		$this->model('MovieRepository');
		$this->view('home' . DIRECTORY_SEPARATOR . 'movies', $this->model->get_movies());
		$this->view->page_title = 'Movies';
		$this->view->render();
	}

	//Show one movie page
	public function movie($id='', $name='')
	{
		$this->model = Movie::withId($id);
		$this->view('home' . DIRECTORY_SEPARATOR . 'movie', $this->model);


		$this->view->page_title = 'Movie#' . $this->model->imdbId;

		$this->view->render();
	}
}
?>