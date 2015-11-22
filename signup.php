<?php
ob_start();
session_start();

require('connect.php');
if(isset($_SESSION['username']))
{
	header('location:index.php');
}
else
{
	if(isset($_POST['email'])&&isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['fname'])&&isset($_POST['lname'])&&isset($_POST['phone'])&&isset($_POST['address']) &&isset($_POST['city'])&&isset($_POST['state'])&&isset($_POST['zip'])&&isset($_POST['country']))
	{
		$email=mysqli_real_escape_string($con, $_POST['email']);
		$username=mysqli_real_escape_string($con, $_POST['username']);
		$password=mysqli_real_escape_string($con, $_POST['password']);
		$fname=mysqli_real_escape_string($con, $_POST['fname']);
		$lname=mysqli_real_escape_string($con, $_POST['lname']);
		$phone=mysqli_real_escape_string($con, $_POST['phone']);
		$address=mysqli_real_escape_string($con, $_POST['address']);
		$city=mysqli_real_escape_string($con, $_POST['city']);
		$state=mysqli_real_escape_string($con, $_POST['state']);
		$zip=mysqli_real_escape_string($con, $_POST['zip']);
		$country=mysqli_real_escape_string($con, $_POST['country']);

		if(!empty($fname)&&!empty($lname)&&!empty($email)&&!empty($username)&&!empty($password)&&!empty($phone)&&!empty($address)&&!empty($city)&&!empty($state)&&!empty($zip)&&!empty($country))
		{
			$q="INSERT INTO customers(customerNumber, customerLastName, customerFirstName, phone, addressLine1, city,state1,postalCode, country, username, password, emailid) VALUES ('', '$lname','$fname','$phone,'$address','$city','$state', '$zip','$country', '$username','$password', '$email')";
			mysqli_query($con, $q);
			echo '<br/>Registration Complete!!';
			header('location:login.php');
		}
	}
}
?>
