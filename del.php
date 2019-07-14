<?php
    session_start();
	include_once 'dbconnect.php';
	$usrid = $_SESSION['weather'];

    mysqli_query($conn,"DELETE FROM login WHERE usrid='$usrid'");
    mysqli_query($conn,"DELETE FROM profile WHERE usrid='$usrid'");
    mysqli_query($conn,"DELETE FROM blocked WHERE usrid='$usrid'");
    unset($_SESSION['weather']);
    session_unset();
    session_destroy();
    header("location: index.php");
    exit;

?>