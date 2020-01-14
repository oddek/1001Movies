<?php

	class Parser
	{
		private $configs;
		public function GetAllMovies()
		{
			 $this->configs = include('config.php');
			$movies = array();
			$content = file(DATA . "Urls.txt");
			foreach($content as $line)
			{
				array_push($movies, $this->GetMovie(trim($line)));
			}
			return $movies;
		}

		public function GetMovie($id)
		{
			//var_dump($id);
			$url = "http://www.omdbapi.com/?i=" . $id . "&apikey=". $this->configs['apiKey'];
			//var_dump($url);
			$json = file_get_contents($url);
			$movie = json_decode($json);
			//var_dump($movie);
			return $movie;
		}
	}
?>