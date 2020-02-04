<?php
require('Parser.php');
//Provides a seed method. A method for initializing the db. And methods for reading and writing data to the db. Some of the methods are very specific, whilst others are more general.
class Sql
{
	protected $conn;

	function __construct()
	{
		$configs = include('config.php');
		$this->conn = new mysqli($configs['dbServername'], $configs['dbUsername'], $configs['dbPassword'], $configs['dbName']);

		if (!$this->conn) 
		{
    		die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
    	}
		if($this->conn->connect_error)
		{
			die("Connection failed: " . $this->conn->connect_error);
		}
		/* change character set to utf8 */
		if (!$this->conn->set_charset("utf8")) {
    		printf("Error loading character set utf8: %s\n", $this->conn->error);
    		exit();
		}
	}

	public function addUser($firstName, $lastName, $email, $hash)
	{
		if(!$stmt = $this->conn->prepare("INSERT INTO Users(FirstName, LastName, Email, Password) VALUES(?, ?, ?, ?)"))
		{
			//echo "Prepare failed: (" . $this->conn->errno . ") " . $this->conn->error;
			return false;
		}
		if(!$stmt->bind_param("ssss", $firstName, $lastName, $email, $hash))
		{
			//echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			return false;
		}
		if(!$stmt->execute())
		{
			//echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
			return false;
		}
		return true;
	}

	public function SetMovieAsViewed($movieId, $rating = 0)
	{
		$userId = $_SESSION['UID'];

		$query = "INSERT INTO UserMovie(UserId, MovieId, Viewed, PersonalRating) VALUES ($userId, $movieId, 1, $rating) ON DUPLICATE KEY UPDATE PersonalRating = $rating";
		//var_dump($query);
		$results = mysqli_query($this->conn, $query);

	}

	public function SetMovieAsNotViewed($movieId)
	{
		$userId = $_SESSION['UID'];
		$query = "DELETE FROM userMovie WHERE UserId = '$userId' AND MovieId = '$movieId'";
		//var_dump($query);
		$results = mysqli_query($this->conn, $query);
	}

	public function SaveImageToPosterFolder($url, $ImdbId)
	{
		$destdir = CONTENT . "img" . DIRECTORY_SEPARATOR . "posters" . DIRECTORY_SEPARATOR;
   		#$img=file_get_contents($url);
		$buffer = '';
    	$handle = @fopen($url, "r");
		if ($handle) {
		   while (!feof($handle)) {
		       $buffer .= fgets($handle, 4096);
		       //echo $buffer;
		   }
		   fclose($handle);
		}

		   $filename = $destdir . $ImdbId .".jpg";
		   $mystring = fopen($filename, "wb");
		   $handle = fopen($filename, "wb");
		   $numbytes = fwrite($handle, $buffer);
		   fclose($handle);
	}

	public function get_users_count_seen_movie($movieId)
	{
		$query = "SELECT COUNT(DISTINCT UserId) AS cnt FROM UserMovie WHERE MovieId = '$movieId'";
		$results = mysqli_query($this->conn, $query);
		$row = $results->fetch_assoc();
		return "{$row['cnt']}";
	}

	public function get_users_count()
	{
		$query = "SELECT COUNT(DISTINCT Id) AS cnt FROM Users";
		$results = mysqli_query($this->conn, $query);
		$row = $results->fetch_assoc();
		return "{$row['cnt']}";
	}

	public function get_count_of_table_where($table, $column, $data)
	{
		$query = "SELECT COUNT(DISTINCT MovieId) AS cnt FROM UserMovie WHERE $column = '$data'";
		$results = mysqli_query($this->conn, $query);
		$row = $results->fetch_assoc();
		return "{$row['cnt']}";
	}

	public function custom_query($query)
	{
		return mysqli_query($this->conn, $query);
	}

	public function delete_user($userId)
	{
		//Delete posts
		$query = "DELETE FROM Posts WHERE UserId = $userId";
		mysqli_query($this->conn, $query);

		//Delete ratings:
		$query = "DELETE FROM UserMovie WHERE UserId = $userId";
		mysqli_query($this->conn, $query);

		$query = "DELETE FROM Users WHERE Id = $userId";
		var_dump(mysqli_query($this->conn, $query));
	}

	public function select_all($table)
	{
		$query = "SELECT * FROM $table";
		#$query->bind_param("s", $table);

		return mysqli_query($this->conn, $query);
	}

	public function select_specified($table, $column, $data)
	{
		$query = "SELECT * FROM $table WHERE $column = '$data'";
		return mysqli_query($this->conn, $query);
	}

	public function update_field_where($table, $column, $data, $column2, $data2)
	{
		$query = "UPDATE $table SET $column = '$data' WHERE $column2 = '$data2'";
		$results = mysqli_query($this->conn, $query);
	}

	public function delete_row_where($table, $column, $data)
	{
		$query = "DELETE FROM $table WHERE $column = '$data'";
		$results = mysqli_query($this->conn, $query);
	}

	public function save_token($user, $token)
	{
		$query = "INSERT INTO passwordresets(UserId, Token) VALUES ('$user->Id', '$token')";
		$results = mysqli_query($this->conn, $query);
	}

	public function add_post($movieId, $content)
	{
		$userId = $_SESSION['UID'];

		$query = "INSERT INTO Posts(UserId, MovieId, Content) VALUES ('$userId', '$movieId', '$content')";
		$results = mysqli_query($this->conn, $query);
	}

	public function seed_database()
	{
		$hash = password_hash('1234', PASSWORD_DEFAULT);
		$this->custom_query("INSERT INTO Users(Id, FirstName, LastName, Email, Password, IsAdmin) VALUES(1, 'Kent', 'Odde', 'kentodde89@gmail.com', '$hash', 1)");

		$this->custom_query("INSERT INTO Users(Id, FirstName, LastName, Email, Password, IsAdmin) VALUES(2, 'Kristine', 'Enga', 'k.enga@ebnett.no', '$hash', 0)");

		/*SEED MOVIES*/
		$parser = new Parser;
		$movies = $parser->getAllMovies();

		foreach($movies as $movie)
		{
			$title = $movie->Title;
			$year = $movie->{'Year'};
			$runtime = $movie->{'Runtime'};
			$imdbRating = $movie->{'imdbRating'};
			$imdbId = $movie->{'imdbID'};
			$directors = $movie->{'Director'};
			$actors = $movie->{'Actors'};
			$writers = $movie->{'Writer'};
			$genres = $movie->{'Genre'};
			$language = $movie->{'Language'};
			$country = $movie->{'Country'};
			$rated = $movie->{'Rated'};
			$plot = $movie->{'Plot'};
			$posterUrl = $movie->{'Poster'};

			$this->SaveImageToPosterFolder($posterUrl, $imdbId);
			$localUrl = "posters" . DIRECTORY_SEPARATOR . $imdbId . ".jpg";

			if(!$stmt = $this->conn->prepare("INSERT INTO Movies(Title, Year, Runtime, ImdbRating, ImdbId, Director, Actors, Writers, Genres, Language, Country, Rated, Plot, PosterUrl) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"))
			{
				echo "Prepare failed: (" . $this->conn->errno . ") " . $this->conn->error;
			}
			if(!$stmt->bind_param("siidssssssssss", $title, $year, $runtime, $imdbRating, $imdbId, $directors, $actors, $writers, $genres, $language, $country, $rated, $plot, $localUrl))
			{
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			if(!$stmt->execute())
			{
				echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
			}
		}
	}

	public function init_db()
	{
	 	$user_table_query = 
		"
			CREATE TABLE IF NOT EXISTS Users 
			(
			Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			FirstName VARCHAR(50) NOT NULL,
			LastName VARCHAR(50) NOT NULL,
			Email VARCHAR (100) NOT NULL UNIQUE,
			Password VARCHAR(255) NOT NULL,
			IsAdmin TINYINT(1) NOT NULL DEFAULT 0
			)
		";

		$reset_password_table_query = 
		"
			CREATE TABLE IF NOT EXISTS PasswordResets
			(
				UserId INT NOT NULL,
				Token VARCHAR(255) NOT NULL PRIMARY KEY,
				Expires TIMESTAMP,
				FOREIGN KEY (UserId) REFERENCES Users(Id) 
			)
		";

		$movie_table_query = 
			"
				CREATE TABLE IF NOT EXISTS Movies 
				(
				Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				Title VARCHAR(50) NOT NULL,
				Year INT NOT NULL,
				Runtime INT NOT NULL,
				ImdbRating DECIMAL(2,1) NOT NULL DEFAULT 0.0,
				ImdbId VARCHAR(50) NOT NULL UNIQUE,
				Director VARCHAR(100) NOT NULL,
				Actors VARCHAR(1000) NOT NULL,
				Writers VARCHAR(1000) NOT NULL,
				Genres VARCHAR(1000) NOT NULL,
				Country VARCHAR(1000) NOT NULL,
				Language VARCHAR(1000) NOT NULL,
				Rated VARCHAR(50) NOT NULL,
				Plot TEXT NOT NULL,
				PosterUrl VARCHAR(1000) NOT NULL DEFAULT 'https://images-na.ssl-images-amazon.com/images/I/518SFRAZM2L._SX385_BO1,204,203,200_.jpg'
				)
			";

		$user_movie_query =
			"
				CREATE TABLE IF NOT EXISTS UserMovie
				(
				MovieId INT NOT NULL,
				UserId INT NOT NULL,
				Viewed TINYINT(1) NOT NULL DEFAULT 0,
				PersonalRating INT NOT NULL DEFAULT 0,
				PRIMARY KEY (MovieId, UserId),
				FOREIGN KEY (MovieId) REFERENCES Movies(Id),
				FOREIGN KEY (UserId) REFERENCES Users(Id)
				)
			";

		$post_table_query =
			"
				CREATE TABLE IF NOT EXISTS Posts
				(
				Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				MovieId INT NOT NULL,
				UserId INT NOT NULL,
				Content TEXT NOT NULL,
				PostedAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
				UpdatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				FOREIGN KEY (MovieId) REFERENCES Movies(Id),
				FOREIGN KEY (UserId) REFERENCES Users(Id)
				)
			";

		mysqli_query($this->conn, $user_table_query);
		mysqli_query($this->conn, $reset_password_table_query);
		mysqli_query($this->conn, $movie_table_query);
		mysqli_query($this->conn, $user_movie_query);
		mysqli_query($this->conn, $post_table_query);
	}
}