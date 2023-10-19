<?php

function api_request($endpoint, $method = 'GET', $variables = []){
    $client = curl_init();
    $url = 'http://myapi.com/api.php';
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true); //returns the query string

    // GET - C
    if($method == 'GET'){
        $url .= "?endpoint=$endpoint";
        if(!empty($variables)){
            $url .= "&" . http_build_query($variables);
        }
    }
    //POST - R
    if($method == 'POST'){
        $variables = json_decode(file_get_contents("php://input"));
        $variables = array_merge(['endpoint' => $endpoint], $variables);
        curl_setopt($client, CURLOPT_POSTFIELDS, $variables);
    }
    //PATCH - U

    //DELETE - D

    curl_setopt($client, CURLOPT_URL, $url);

    $response = curl_exec($client);

    return json_decode($response, true); // returns the required associative array

}

//$call = api_request('contact', 'GET', '');

include_once 'frontend.php';