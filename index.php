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
        //$variables = array_merge() ?? => q faz iss
    }
    //PATCH - U

    //DELETE - D

    curl_setopt($client, CURLOPT_URL, $url);

    $response = curl_exec($client);

    return json_decode($response, true); // returns the required associative array

}

$call = api_request('contact', 'GET', ['exclusive' => true]);
var_dump($call);

include_once 'frontend.php';