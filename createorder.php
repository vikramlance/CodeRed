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