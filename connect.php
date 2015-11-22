<?php

	$host="us-cdbr-azure-west-c.cloudapp.net";
	$user="bd0e3aeafe641e";
	$pass="1e8243d1";
	$dbname="codereddb";
	
	$con=mysqli_connect($host, $user, $pass, $dbname);
	
	if(!$con)
	{
		echo 'Database could not be connected! Please contact us by reporting an error';
		die();
	}
?>