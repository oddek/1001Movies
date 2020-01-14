<?php


class PostRepository extends Model
{
	public $posts = array();

	function __construct($movieId)
	{
		parent::__construct();

		$res = self::$core->sql->select_specified('posts', 'MovieId', $movieId);

		while($row = $res->fetch_assoc())
		{
			$post = Post::withRow($row);
			array_push($this->posts, $post);
		}
	}

}