<?php session_start();
require 'setDB.php';
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

        //creating table if it does not exist
        if(!$mysql->query('SELECT 1 FROM `items` LIMIT 1')) {
            create_items();
        }
        file_put_contents('test.txt', session_id());
        //sending request to add item
        $query = "INSERT INTO items SET text = \"$text\", checked = \"false\", user_id = \"" . $_SESSION['login'] . "\";";
        $mysql->query($query);
        $id = mysqli_insert_id($mysql);
    }

    $arr = array("id" => (string)$id);

    echo json_encode($arr);
}


