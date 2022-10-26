<?php
require 'setDB.php';
require 'corsHeaders.php';
require 'mysqlConfig.php';
require 'errorsController.php';



if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //decoding query
    $decoded_query = json_decode(file_get_contents('php://input'), true);

    if(register_user($decoded_query['login'], $decoded_query['pass'])){
        echo json_encode(array('ok' => true));
    }
}

function register_user($login, $password){
    $mysql = database_connect();
    //checking has the table exists
    if(!$mysql->query('SELECT 1 FROM `users` LIMIT 1')){
        create_users();
    }
    //checking has the login taken
    $stmt = $mysql->prepare('SELECT * FROM users WHERE login = ?');
    $stmt->bind_param('s', $login);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_row();
    if(isset($res[0])){
        outputError(400);
        return false;
    } else{
        //if login is not taken - adding user to the DB
        $stmt = $mysql->prepare('INSERT INTO users SET login = ?, password = ?');
        $stmt->bind_param('ss', $login, $password);
        $stmt->execute();
        return true;
    }
}