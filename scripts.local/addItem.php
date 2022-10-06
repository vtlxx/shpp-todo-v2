<?php
$base_name = 'todo';
$http_url = 'http://todo.local';


header('Access-Control-Allow-Origin: ' . $http_url);
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $decoded_json = json_decode(file_get_contents('php://input'), true);
    $text = $decoded_json['text'];

    $id = 0;

    $mysql = mysqli_connect('localhost', 'root', '', $base_name);

    if($mysql){
        mysqli_set_charset($mysql, 'utf8');

        $val = $mysql->query('SELECT 1 FROM `items` LIMIT 1');
        //creating table if it does not exist
        if(!$val) {
            $query = 'CREATE TABLE items (id INT AUTO_INCREMENT KEY, text VARCHAR(120), checked VARCHAR(6))';
            $mysql->query($query);
        }
        //sending request to add item
        $query = "INSERT INTO items SET text = \"$text\", checked = \"false\"";
        $mysql->query($query);
        $id = mysqli_insert_id($mysql);
    }

    $arr = array("id" => (string)$id);

    echo json_encode($arr);
}


