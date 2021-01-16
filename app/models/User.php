<?php
class User extends Model
{
	public
	$Id,
	$FirstName,
	$LastName,
	$Email,
	$Password,
	$IsAdmin;

	function __construct()
	{
		parent::__construct();
	}

	public static function withRow($row)
	{
		$instance = new self();
		$instance->fill($row);
		return $instance;
	}

	public static function withId($Id)
	{
		$instance = new self();
		$res = $instance::$core->sql->select_specified("users", "Id", $Id);
		$row = $res->fetch_assoc();
		$instance->fill($row);
		return $instance;
	}

	public static function withToken($token)
	{
		$instance = new self();
		$query = "SELECT * FROM users LEFT JOIN passwordresets ON users.Id = passwordResets.UserId";

		$res = $instance->core->sql->custom_query($query);

		if($res && $res->num_rows != 0)
		{
			$row = $res->fetch_assoc();
			$instance->fill($row);
			return $instance;
		}
		return null;
	}

	public function fill($row)
	{
		if($row)
		{
			$this->Id = "{$row['Id']}";
			$this->FirstName = "{$row['FirstName']}";
			$this->LastName = "{$row['LastName']}";
			$this->Email = "{$row['Email']}";
			$this->Password = "{$row['Password']}";
			$this->IsAdmin = ("{$row['IsAdmin']}")  ? true : false;
		}

	}
}
