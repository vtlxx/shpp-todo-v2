<?php
require 'corsHeaders.php';
require 'mysqlConfig.php';
require 'errorsController.php';

if($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $item_id = json_decode(file_get_contents('php://input'), true)['id'];

    delete_item($item_id);
}

function delete_item($id){
    $mysql = database_connect();
    mysqli_set_charset($mysql, 'utf8');
    $stmt = $mysql->prepare('DELETE FROM items WHERE id = ?');
    $stmt->bind_param('s', $id);
    $stmt->execute();
    echo json_encode(array('ok' => true));
}