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
    //sending request to add item
    $stmt = $mysql->prepare('INSERT INTO items SET text = ?, checked = ?, user_id = ?');
    $stmt->bind_param('sss', $text, $isChecked, $_SESSION['login']);
    $isChecked = 'false';
    $stmt->execute();
    return $stmt->insert_id;
}


