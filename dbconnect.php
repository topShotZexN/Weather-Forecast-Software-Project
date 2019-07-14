<?php
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBNAME', 'weather');
	
	$conn = mysqli_connect(DBHOST,DBUSER,DBPASS, DBNAME) or die("Connection failed : ")
?>
