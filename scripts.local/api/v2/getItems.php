<?php
session_start();
require 'corsHeaders.php';
require 'mysqlConfig.php';
require 'errorsController.php';

echo json_encode(array('items' => get_items_from_tasks($_SESSION['login'])));


function get_items_from_tasks($id){
    $mysql = database_connect();
    //checking if exists table 'items'
    $val = $mysql->query('SELECT 1 FROM items LIMIT 1');
    if($val) {
        //sending query and receiving task
        $stmt = $mysql->prepare('SELECT * FROM items WHERE user_id = ? ORDER BY id DESC');
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        //fetching task to the associative array
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        //transform 'checked' parameter from string to the boolean
        for($i = 0; $i < sizeof($rows); $i++){
            $rows[$i]['checked'] = $rows[$i]['checked'] == 'true';
        }
        return $rows;
    } else {
        return array();
    }
}
