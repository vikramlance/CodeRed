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
<?php include('header.php'); ?>
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
								<li><a href="checkout.php"><i class="fa fa-crosshairs"></i> How it works</a></li>

								<li>
									<?php
if(!isset($_SESSION['username']))
{
	echo '<a href="login.php"><i class="fa fa-lock"></i> Login/Signup</a>';
}
else
{
	echo '<a href="logout.php"><i class="fa fa-lock"></i> Logout</a>';
}
?>
								</li>
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
																	</div>
									<input type="submit" name="Submit" value="Submit" />
									
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

<footer id="footer"><!--Footer-->

		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Online Help</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Order Status</a></li>
								<li><a href="#">Change Location</a></li>
								<li><a href="#">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privecy Policy</a></li>
								<li><a href="#">Refund Policy</a></li>
								<li><a href="#">Billing System</a></li>
								<li><a href="#">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>

	</footer><!--/Footer-->



    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>


	</body>
</html>