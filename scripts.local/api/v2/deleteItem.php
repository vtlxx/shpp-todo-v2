<?php
require 'corsHeaders.php';
require 'mysqlConfig.php';

if($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $item_id = json_decode(file_get_contents('php://input'), true)['id'];

    delete_item($item_id);
    echo json_encode(array('ok' => true));
}

function delete_item($id){
    $mysql = database_connect();
    mysqli_set_charset($mysql, 'utf8');
    $query = "DELETE FROM items WHERE id = $id;";
    $mysql->query($query);
}