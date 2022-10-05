<?php
$base_url = 'base.json';
$http_url = 'http://todo.local';

$items = array();
if(file_get_contents($base_url)){
    $decoded_base = json_decode(file_get_contents($base_url), true);
    $items = $decoded_base['items'];
}

//print_r($items);

header('Access-Control-Allow-Origin: ' . $http_url);
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

echo json_encode(array('items' => $items));
//{"items":[{}]}
//echo '{"items":[{}]}';