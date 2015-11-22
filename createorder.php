<?php
ob_start();
session_start();
require('connect.php');

if(!isset($_SESSION['username']))
{
	header('location:index.php');
}
else
{
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>Home | BuyMyGroc</title>
    <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@buymegroc.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/header_top-->
<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.php"><img src="images/home/logo.png" alt="" /></a>
						</div>

					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="createorder.php"><i class="fa fa-user"></i> Create</a></li>
								<li><a href="discover.php"><i class="fa fa-star"></i> Discover</a></li>
								<li><a href="checkout.php"><i class="fa fa-shopping-cart"></i> Cart</a></li>

									<?php
if(!isset($_SESSION['username']))
{
	echo '<li><a href="login.php"><i class="fa fa-lock"></i> Login/Signup</a></li>';
}
else
{
	echo '<li><a href="myorders.php"><i class="fa fa-crosshairs"></i> My Orders</a></li>';
	echo '<li><a href="logout.php"><i class="fa fa-lock"></i> Logout</a></li>';
}
?>
						</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->


	<section>
		<div class="container">
			<div class="row" style="margin:auto">

							<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-12">

													<!--/product-information-->
							<div class="product-search">
							<?php


if(isset($_POST['search_query']) && !empty($_POST['search_query']))
{
	$apiKey = "pf9r2nkqfbhsd2a72xnyp9v2";
	$userAgent = $_SERVER['HTTP_USER_AGENT'];
	$search = $_POST['search_query'];
	$searchquery='http://api.walmartlabs.com/v1/search?query='.$search.'&format=json&apiKey='.$apiKey;

	// Get cURL resource
	$curl = curl_init();
	// Set some options - we are passing in a useragent too here
	curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $searchquery,
			CURLOPT_USERAGENT => $userAgent
		));
	// Send the request & save response to $resp
	$resp = curl_exec($curl);
	// Close request to clear up some resources
	curl_close($curl);

	$array = json_decode($resp, true);

}
?>
<p>
								<form action="createorder.php" method="POST">
								<div class="col-sm-3">
								<div class="search_box pull-right">
																	<input type="text" name="search_query" id="search_query" class="search_box" <?php if($_POST){ echo 'value='.trim($array['query']);} else {echo 'placeholder="Search"';} ?> />
																	</div>

									<input type="submit" name="Submit" value="Submit" />
									</div>

									<br/>

								</form>
</p>

							<?php
$itemlist = $array['items'];
for ($i=0; $i < sizeof($array['items']) ; ++$i) {
	//echo $itemlist[$i]['itemId'];
	$itemname=$itemlist[$i]['name'];
	$itemid=$itemlist[$i]['itemId'];
	$itemimage=$itemlist[$i]['thumbnailImage'];
	$itemprice = $itemlist[$i]['salePrice'];
	$category=$itemlist[$i]['categoryPath'];

	//orderno, productcode, name, price, qunatity
	echo '<div class="product-information">
								<h2>'.$itemname.'</h2>
								<p>Item ID: '.$itemid.'</p>
								<img src="'.$itemimage.'" alt="" />
								<span>
									<span>US $'.$itemprice.'</span>
									<label>Quantity:</label>
									<input type="text" value="1"  readonly="readonly"/>
									<button type="button" class="btn btn-fefault cart">
										<a href="additem.php?pid='.$itemid.'&name='.$itemname.'&price='.$itemprice.'&quantity=1" >
										<i class="fa fa-shopping-cart"></i>
										Select Item</a>
									</button>
								</span>
								<p><b>Availability:</b> In Stock</p>
								<p><b>Category:</b>'.$category.'</p>
							</div>';
}
?>
<?php
$userid=$_SESSION['userid'];
$squery="SELECT * FROM orderdetails, orders WHERE orderdetails.order_creator_id='$userid' AND orders.status <> 'completed' AND orderdetails.orderNumber = orders.orderNumber";
//echo $squery;
$sresult=mysqli_query($con, $squery);

while ($row = mysqli_fetch_array($sresult))
{
	echo $row['productCode'].'<br/>'.$row['productName'].'<br/>'.$row['priceEach'];
}
?>
							<!--/product-information-->
						</div>
					</div><!--/product-details-->


			</div>
		</div>
	</section>


		<div class="container">
			<div class="row">

				<div class="col-sm-9 padding-right">


				</div>
			</div>
		</div>
	</section>

<?php include('footer.php'); ?>


	</body>
</html>