<html>
<body>
<form action="trial.php" method="POST">
	<label for="search_query">Query</label>
	<input type="text" name="search_query" id="search_query" />
	<input type="submit" name="Submit" />
</form>

<?php
	$apiKey = "pf9r2nkqfbhsd2a72xnyp9v2";
	$userAgent = $_SERVER['HTTP_USER_AGENT'];
	$search = $_POST['search_query'];
	$searchquery='http://api.walmartlabs.com/v1/search?query='.$search.'&format=json&apiKey='.$apiKey;

	echo $searchquery;

	if(isset($_POST['search_query']))
	{
		$search=$_POST['search_query'];
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

		var_dump(json_decode($resp));
	}
?>

</body>

</html>