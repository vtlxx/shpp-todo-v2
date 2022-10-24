<?php
session_start();
require 'corsHeaders.php';
require 'mysqlConfig.php';

echo json_encode(array('items' => get_items_from_tasks($_SESSION['login'])));


function get_items_from_tasks($id){
    $mysql = database_connect();
    $val = $mysql->query('SELECT 1 FROM items LIMIT 1');
    if($val) {
        $result = $mysql->query('SELECT * FROM items WHERE user_id = "'. $id . '" ORDER BY id DESC');
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        for($i = 0; $i < sizeof($rows); $i++){
            $rows[$i]['checked'] = $rows[$i]['checked'] == 'true';
        }
        return $rows;
    } else {
        return array();
    }
}
