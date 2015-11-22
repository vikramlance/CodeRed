<?php

	$host="localhost";
	$user="root";
	$pass="";
	$dbname="codereddb";
	
	$con=mysqli_connect($host, $user, $pass, $dbname);
	
	if(!$con)
	{
		echo 'Database could not be connected! Please contact us by reporting an error';
		die();
	}
?>