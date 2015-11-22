<?php
ob_start();
session_start();
require('connect.php');

if($_GET)
{
	$pcode=mysqli_real_escape_string($con, $_GET['pid']);
	$name=mysqli_real_escape_string($con,$_GET['name']);
	$price=mysqli_real_escape_string($con,$_GET['price']);
	$qty=mysqli_real_escape_string($con,$_GET['quantity']);
	$creatorid=$_SESSION['userid'];

	$query="SELECT orderNumber FROM Orders WHERE status='cart' AND order_creator_id='$creatorid'";
	//echo $query;die();
	$res=mysqli_query($con,$query);
	if(mysqli_num_rows($res)>0)
	{
		$row=mysqli_fetch_array($res);
		$ordernum=$row['orderNumber'];
	}
	else
	{
		$query1="SELECT max(orderNumber) FROM Orders";
		$res1=mysqli_query($con,$query);
		$row=mysqli_fetch_array($res1);
		$ordernum=$row[0];
	}
	//echo $pcode.'<br/>'.$name.'<br/>'.$price.'<br/>'.$qty.'<br/>'.$ordernum;
	//die();

	if(isset($pcode)&&isset($name)&&isset($price)&&isset($qty))
	{

		$q="INSERT INTO orderdetails(productCode, orderNumber, quantityOrdered, order_creator_id, priceEach, productName) VALUES ('$pcode', '$ordernum','$qty','$creatorid', '$price', '$name')";

		//echo $q;die();
		mysqli_query($con, $q);
		echo "Item added successfully";
		header('location:createorder.php');
	}
}

?>