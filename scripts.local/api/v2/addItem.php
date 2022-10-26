<?php session_start();
require 'setDB.php';
require 'corsHeaders.php';
require 'mysqlConfig.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $decoded_json = json_decode(file_get_contents('php://input'), true);
    $text = $decoded_json['text'];

    $id = add($text);

    echo json_encode(array("id" => (string)$id));
}

function add($text){
    $mysql = database_connect();
    //creating table if it does not exist
    if(!$mysql->query('SELECT 1 FROM `items` LIMIT 1')) {
        create_items();
    }
    file_put_contents('test.txt', session_id());
    //sending request to add item
    $query = "INSERT INTO items SET text = \"$text\", checked = \"false\", user_id = \"" . $_SESSION['login'] . "\";";
    $mysql->query($query);
    return mysqli_insert_id($mysql);
}


