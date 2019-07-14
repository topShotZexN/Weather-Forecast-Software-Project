<?php

	session_start();
	include_once 'dbconnect.php';
	    $usrid = $_SESSION['weather'];
		unset($_SESSION['weather']);
		session_unset();
		session_destroy();
		header("Location: index.php");
		exit;
?>