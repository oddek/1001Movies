<?php

	class Parser
	{

		public function GetAllMovies()
		{
			$movies = array();
			$content = file(DATA . "test.txt");
			foreach($content as $line)
			{
				array_push($movies, $this->GetMovie(trim($line)));
			}
			return $movies;
		}

		public function GetMovie($id)
		{
			//var_dump($id);
			$url = "http://www.omdbapi.com/?i=" . $id . "&apikey=7cf50d10";
			//var_dump($url);
			$json = file_get_contents($url);
			$movie = json_decode($json);
			//var_dump($movie);
			return $movie;
		}
	}
?>