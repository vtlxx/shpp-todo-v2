<?php
require 'corsHeaders.php';
require 'mysqlConfig.php';

if($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $item = json_decode(file_get_contents('php://input'), true);

    change_item($item['checked'], $item['text'], $item['id']);

    echo json_encode(array('ok' => true));
}

function change_item($checked, $text, $id){
    $mysql = database_connect();
    $checked = $checked ? 'true' : 'false';
    $query = "UPDATE items SET text = '" . $text . "', checked = '$checked' WHERE `id` = " . $id . ";";
    $mysql->query($query);
}
