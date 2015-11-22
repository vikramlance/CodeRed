<?php
ob_start();
require('connect.php');

if($_GET)
{
	$pcode=$_GET['pid'];
	$name=$_GET['name'];
	$price=$_GET['price'];
	$qty=$_GET['quantity']);
	$creatorid=$_SESSION['userid'];
	
	$query="SELECT orderNumber FROM Orders WHERE status='cart'";
	$res=mysqli_query($con,$query);
	if(mysqli_num_rows($res)>0)
	{
		$row=mysqli_fetch_array($res);
		$ordernum=$row['orderNumber'];
	}
	
	if(isset($pid)&&isset($name)&&isset($price)&&isset($qty))
	{
		if($ordernum)
		{
			$q="INSERT INTO (productCode, orderNumber, quantityOrdered, order_creator_id, priceEach, productName) VALUES ('$pcode', '$ordernum','$qty','$creatorid', '$price', '$name')";
			}
			else
			{
		$q="INSERT INTO (productCode, orderNumber, quantityOrdered, order_creator_id, priceEach, productName) VALUES ('$pcode','','$qty','$creatorid', '$price', '$name')";
		}
		echo $q;die();
		//mysqli_query($con, $q);
		echo "Item added successfully";
		header('location:createorder.php');
	}
}

?>