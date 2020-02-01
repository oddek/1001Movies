<?php
//Holds all movies.
class MovieRepository extends Model
{
	public $movies = array();

	function __construct()
	{
		parent::__construct();
		$user = User::withId($_SESSION['UID']);
		$query = 
		"
		SELECT *
		FROM Movies mov
		LEFT JOIN UserMovie usrmov ON mov.Id = usrmov.MovieId
		AND usrmov.UserId = $user->Id
		ORDER BY mov.Year ASC
		";

		$res = self::$core->sql->custom_query($query);
		while($row = $res->fetch_assoc())
		{
			$movie = Movie::withRow($row);
			array_push($this->movies, $movie);
		}
	}

	public function get_movies()
	{
		return $this->movies;
	}
}