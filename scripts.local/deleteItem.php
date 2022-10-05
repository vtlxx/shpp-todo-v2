<?php
$base_url = 'base.json';
$http_url = 'http://todo.local';

header('Access-Control-Allow-Origin: ' . $http_url);
header('Access-Control-Allow-Methods: DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $item_id = json_decode(file_get_contents('php://input'), true)['id'];
    if(file_get_contents($base_url)){
        $decoded_base = json_decode(file_get_contents($base_url), true);
        $items = $decoded_base['items'];


        //finding and changing value of [$id] item
        for($i = 0; $i < sizeof($items); $i++){
            if($items[$i]['id'] == $item_id){
                array_splice($items, $i, 1);
            }
        }
        $decoded_base['items'] = $items;
        file_put_contents($base_url, json_encode($decoded_base));
    }
    echo json_encode(array('ok' => true));
}