<?php

class UserRepository extends Model
{
	public $users = array();

	function __construct()
	{
		parent::__construct();


		$res = self::$core->sql->select_all('users');

		while ($row = $res->fetch_assoc())
		{
			$user = User::withRow($row);
			array_push($this->users, $user);
			
		}
	}

	public function get_users()
	{
		return $this->users;
	}

	public function load_all_users()
	{
		$this->users = $this->db->select_all('Users');
	}

	public function load_users_where($column, $data)
	{
		$this->users = $this->db->select_specified($column, $data);
	}
}