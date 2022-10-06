<?php
$base_name = 'todo';
$http_url = 'http://todo.local';

header('Access-Control-Allow-Origin: ' . $http_url);
header('Access-Control-Allow-Methods: PUT, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $item = json_decode(file_get_contents('php://input'), true);

    $mysql = mysqli_connect('localhost', 'root', '', $base_name);
    if($mysql) {
        mysqli_set_charset($mysql, 'utf8');
        $checked = $item['checked'] ? 'true' : 'false';
        $query = "UPDATE items SET text = '" . $item['text'] . "', checked = '$checked' WHERE `id` = " . $item['id'] . ";";
        $mysql->query($query);
    }

    echo json_encode(array('ok' => true));
}
