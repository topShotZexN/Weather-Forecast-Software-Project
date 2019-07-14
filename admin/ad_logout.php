<?php

	session_start();
	include_once 'dbconnect.php';
	    $usrid = $_SESSION['weather_ad'];
		unset($_SESSION['weather']);
		session_unset();
		session_destroy();
		header("Location: ad_login.php");
		exit;
?>