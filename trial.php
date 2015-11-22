<?php
		$searchquery='http://api.walmartlabs.com/v1/search?query='.$_POST['search_query'].'&format=json&apiKey=pf9r2nkqfbhsd2a72xnyp9v2';
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

?>