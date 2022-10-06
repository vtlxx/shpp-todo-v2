<?php
$base_name = 'todo';
$http_url = 'http://todo.local';

header('Access-Control-Allow-Origin: ' . $http_url);
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

$mysql = mysqli_connect('localhost', 'root', '', $base_name);

if($mysql){
    mysqli_set_charset($mysql, 'utf8');

    $val = $mysql->query('SELECT 1 FROM items LIMIT 1');
    if($val) {
        $result = $mysql->query('SELECT * FROM items ORDER BY id DESC');
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        for($i = 0; $i < sizeof($rows); $i++){
            $rows[$i]['checked'] = $rows[$i]['checked'] == 'true';
        }
        echo json_encode(array('items' => $rows));
    } else {
        echo json_encode(array('items' => array()));
    }
}
