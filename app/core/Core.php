<?php
require('Sql.php');
class Core
{
	public $name, $webmaster_contact, $webmaster_name;
	public $sql;

	public function __construct()
	{
		$this->name = "1001 Movies You Must See Before You Die";
		$this->webmaster_name = "Kent Odde";
		$this->webmaster_contact = "kentodde89@gmail.com";
		$this->sql = new Sql;
	}

	public function isLoggedIn()
	{
		return (isset($_SESSION['UID']));
	}

}