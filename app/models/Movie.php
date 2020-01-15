<?php

class Movie extends Model
{
	public 
	$id,
	$title,
	$year,
	$runtime,
	$imdbRating,
	$imdbId,
	$director,
	$actors,
	$writers,
	$genres,
	$plot,
	$posterUrl,
	$viewed,
	$personalRating,
	$country,
	$language,
	$rated,
	$yearTag,
	$viewsInPercent;

	public $posts = array();
	
	#$viewDate,
	

	public function __construct()
	{
		parent::__construct();
	}

	public static function withRow($row)
	{
		$instance = new self();
		$instance->fill($row);
		return $instance;
	}

	public static function withId($id)
	{
		$instance = new self();
		$userId = $_SESSION['UID'];
		$query = 
		"
		SELECT *
		FROM Movies mov
		LEFT JOIN UserMovie usrmov ON mov.Id = usrmov.MovieId
		AND usrmov.UserId = $userId
		WHERE mov.Id = '$id'
		";

		$res = $instance::$core->sql->custom_query($query);

		$row = $res->fetch_assoc();
		$instance->fill($row);

		$postrepo = new PostRepository($id);
		$instance->posts = $postrepo->posts;
		$instance->calcViewsInPercent();

		return $instance;
	}

	public function calcViewsInPercent()
	{
		$userCount = self::$core->sql->get_users_count();
		$usersSeen = self::$core->sql->get_users_count_seen_movie($this->id);

		$this->viewsInPercent = ($usersSeen/$userCount) * 100;
	}

	public static function withImdbId($id)
	{
		$instance = new self();
		$res = $instance->core->sql->select_specified("movies", 'ImdbId', $id);

		$row = $res->fetch_assoc();

		$instance->fill($row);

		return $instance;
	}


	public function fill($row)
	{
		if($row)
		{	
			$this->id = "{$row['Id']}";
			$this->title = "{$row['Title']}";
			$this->year = "{$row['Year']}";
			$this->runtime = "{$row['Runtime']}";
			$this->imdbRating = "{$row['ImdbRating']}";
			$this->imdbId = "{$row['ImdbId']}";
			$this->director = "{$row['Director']}";
			$this->actors = "{$row['Actors']}";
			$this->writers = "{$row['Writers']}";
			$this->genres = "{$row['Genres']}";
			$this->plot = "{$row['Plot']}";
			$this->posterUrl = "{$row['PosterUrl']}";
			$this->viewed = "{$row['Viewed']}";
			$this->personalRating = "{$row['PersonalRating']}";
			$this->country = "{$row['Country']}";
			$this->language = "{$row['Language']}";
			$this->rated = "{$row['Rated']}";

			if($this->year < 1930)
			{

				$this->yearTag = "year2";
			}
			else if($this->year >= 2000)
			{
				$this->yearTag = "year1" . substr($this->year, 2, 1);
			}
			else
			{
				$this->yearTag = "year" . substr($this->year, 2, 1);
			}
			/*else if ($this->year < 1940) 
			{
				$this->yearTag = "year3";
			}
			else if ($this->year < 1950) 
			{
				$this->yearTag = "year4";
			}
			else if ($this->year < 1960) 
			{
				$this->yearTag = "year5";
			}
			else if ($this->year < 1970) 
			{
				$this->yearTag = "year6";
			}
			else if ($this->year < 1980) 
			{
				$this->yearTag = "year7";
			}
			else if ($this->year < 1990) 
			{
				$this->yearTag = "year8";
			}
			else if ($this->year < 2000) 
			{
				$this->yearTag = "year9";
			}
			else if ($this->year < 2010) 
			{
				$this->yearTag = "year10";
			}
			else 
			{
				$this->yearTag = "year11";
			}*/


		}
	}
}  