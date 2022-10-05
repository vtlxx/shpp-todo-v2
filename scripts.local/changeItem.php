<?php
$base_url = 'base.json';
$http_url = 'http://todo.local';

header('Access-Control-Allow-Origin: ' . $http_url);
header('Access-Control-Allow-Methods: PUT, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $item = json_decode(file_get_contents('php://input'), true);
    if(file_get_contents($base_url)){
        $decoded_base = json_decode(file_get_contents($base_url), true);
        $items = $decoded_base['items'];


        //finding and changing value of [$id] item
        for($i = 0; $i < sizeof($items); $i++){
            if($items[$i]['id'] == $item['id']){
                $items[$i]['text'] = $item['text'] != '' ? $item['text'] : $items[$i]['text'];
                $items[$i]['checked'] = ($item['checked'] || $item['checked'] == false) ? $item['checked'] : $items[$i]['checked'];
            }
        }
        $decoded_base['items'] = $items;
        file_put_contents($base_url, json_encode($decoded_base));
    }
    echo json_encode(array('ok' => true));
}
