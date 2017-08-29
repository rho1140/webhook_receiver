<?php
//Listen for the POST request from BigCommerce
$payload = file_get_contents('php://input');

//BigCommerce product endpoint to send the payload to
$url = 'https://api.bigcommerce.com/stores/{store-hash}/v2/products/{product-id}';

//Headers for OAuth connection
$headers = array(
	'Content-type: application/json',
	'Accept: application/json',
    'X-Auth-Client: {the OAuth client id}',
	'X-Auth-Token: {the OAuth token}'
);

//Content to enter into the product description
$fields = json_encode(array("description" => "$payload"));

//Initiate cURL
$ch = curl_init($url);
//Use the CURLOPT_PUT option to tell cURL that
//this is a PUT request.
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

//Execute the request.
curl_exec($ch);
curl_close($ch);

?>