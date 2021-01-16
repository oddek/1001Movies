<?php

class Post extends Model
{
	public
	$id,
	$movieId,
	$userId,
	$content,
	$created,
	$updated,
	$rating;

	public function __construct()
	{
		parent::__construct();
	}

	public static function withRow($row)
	{
		$instance = new self();
		$instance->fill($row);

		$query =
		"
		SELECT PersonalRating
		FROM usermovie
		WHERE MovieId = $instance->movieId
		AND UserId = $instance->userId
		";
		$res = $instance::$core->sql->custom_query($query);
		if($res && $res->num_rows != 0)
		{
			$row = $res->fetch_assoc();
			$instance->rating = "{$row['PersonalRating']}";
		}
		else
		{
			$instance->rating = 0;
		}
		return $instance;
	}

	public function fill($row)
	{
		if($row)
		{
			$this->id = "{$row['Id']}";
			$this->movieId = "{$row['MovieId']}";
			$this->userId = "{$row['UserId']}";
			$this->content = "{$row['Content']}";
			$this->created = "{$row['PostedAt']}";
			$this->updated = "{$row['UpdatedAt']}";
		}
	}
}
