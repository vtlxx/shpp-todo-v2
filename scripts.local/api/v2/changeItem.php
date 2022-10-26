<?php
require 'corsHeaders.php';
require 'mysqlConfig.php';
require 'errorsController.php';

if($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $item = json_decode(file_get_contents('php://input'), true);

    change_item($item['checked'], $item['text'], $item['id']);

    echo json_encode(array('ok' => true));
}

function change_item($checked, $text, $id){
    $mysql = database_connect();
    //transforming string variable to the boolean
    $checked = $checked ? 'true' : 'false';
    //changing variables in the database
    $stmt = $mysql->prepare('UPDATE items SET text = ?, checked = ? WHERE `id` = ?');
    $stmt->bind_param('sss', $text, $checked, $id);
    $stmt->execute();
}
