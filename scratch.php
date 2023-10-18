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
$param['name'] = 'gabriel';

$column[] = "name LIKE '%". $param['name'] . "%'";
$query = 'SELECT * FROM contacts WHERE ';
$query .= ' ' . implode(' OR', $column);
echo $query;