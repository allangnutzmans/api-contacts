<?php
/*
$curl = curl_init();

$search_string = "pcvideo games 2016";
$url = "https://www.amazon.com/s/field-keywords=$serarch_string";

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//https://m.media-amazon.com/images/I/71ps2ARa8oL._AC_UY218_.jpg

$result = curl_exec($curl);
echo $result;

curl_close($curl);

*/

// Create a cURL handle
$ch = curl_init();

// Set the cURL options
curl_setopt($ch, CURLOPT_URL, 'http://myapi.com/api.php'); // Replace with your API endpoint
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'key1=value1&key2=value2'); // Replace with your POST data
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the cURL session
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'cURL Error: ' . curl_error($ch);
}

// Close the cURL session
curl_close($ch);

// Handle the response
if ($response === false) {
    echo 'cURL request failed';
} else {
    echo 'Response: ' . $response;
}
?>