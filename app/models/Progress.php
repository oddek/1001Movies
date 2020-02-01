<?php
//This is very bad code!!!
//But i had to prototype a solution to get the filtering system to work, and i cant be bothered to fix it.
class Progress extends Model
{
	public $total = 0;
	public $year2 = 0;
	public $year3 = 0;
	public $year4 = 0;
	public $year5 = 0;
	public $year6 = 0;
	public $year7 = 0;
	public $year8 = 0;
	public $year9 = 0;
	public $year10 = 0;
	public $year11 = 0;


	public function __construct()
	{
		parent::__construct();

		$userId = $_SESSION['UID'];

		$movies = new MovieRepository;
		$movies = $movies->movies;

		$totalCount = count($movies);
		$totalSeen = self::$core->sql->get_count_of_table_where("userMovie", "UserId", $userId);

		$totalyear2 = 0;
		$totalyear3 = 0;
		$totalyear4 = 0;
		$totalyear5 = 0;
		$totalyear6 = 0;
		$totalyear7 = 0;
		$totalyear8 = 0;
		$totalyear9 = 0;
		$totalyear10 = 0;
		$totalyear11 = 0;

		$seenyear2 = 0;
		$seenyear3 = 0;
		$seenyear4 = 0;
		$seenyear5 = 0;
		$seenyear6 = 0;
		$seenyear7 = 0;
		$seenyear8 = 0;
		$seenyear9 = 0;
		$seenyear10 = 0;
		$seenyear11 = 0;

		foreach($movies as $movie)
		{
			${'total' . $movie->yearTag} += 1;
			if($movie->viewed)
			{
				${'seen' . $movie->yearTag} += 1;
			}
		}

		if($totalCount != 0) $this->total = $totalSeen * 100 / $totalCount;
		if($totalyear2 != 0) $this->year2 = $seenyear2 * 100 / $totalyear2;
		if($totalyear3 != 0) $this->year3 = $seenyear3 * 100 / $totalyear3;
		if($totalyear4 != 0) $this->year4 = $seenyear4 * 100 / $totalyear4;
		if($totalyear5 != 0) $this->year5 = $seenyear5 * 100 / $totalyear5;
		if($totalyear6 != 0) $this->year6 = $seenyear6 * 100 / $totalyear6;
		if($totalyear7 != 0) $this->year7 = $seenyear7 * 100 / $totalyear7;
		if($totalyear8 != 0) $this->year8 = $seenyear8 * 100 / $totalyear8;
		if($totalyear9 != 0) $this->year9 = $seenyear9 * 100 / $totalyear9;
		if($totalyear10 != 0) $this->year10 = $seenyear10 * 100 / $totalyear10;
		if($totalyear11 != 0) $this->year11 = $seenyear11 * 100 / $totalyear11;

	}


}