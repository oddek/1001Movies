<!DOCTYPE html>
<html>
<head>
	<meta charset="UFT-8">
	<title><?php /*echo (isset($this->page_title) ? $this->page_title : '');*/?></title>

	<link rel="stylesheet" href="/content/css/style.css" type="text/css">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</head>
<body>

	<?php

	$h = "1";
	$hm = $h * 60;
	$ms = $hm * 60;



	$message;
	if(isset($_SESSION['message']))
	{
		$message = $_SESSION['message'];
		$_SESSION['message'] = null;
	}
	?>

