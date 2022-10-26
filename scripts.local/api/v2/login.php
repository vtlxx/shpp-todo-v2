<?php
session_start();
require 'corsHeaders.php';
require 'mysqlConfig.php';
require  'errorsController.php';


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //decoding query
    $decoded_query = json_decode(file_get_contents('php://input'), true);
    //checking has login correct
    login($decoded_query['login'], $decoded_query['pass']);
}

function login($login, $password){
    $mysql = database_connect();
    $val = $mysql->query('SELECT 1 FROM `users` LIMIT 1');
    //if table 'users' exists
    if($val){
        //searching for user with $login and $password
        $stmt = $mysql->prepare('SELECT COUNT(1) FROM users WHERE login = ? AND password = ?');
        $stmt->bind_param('ss', $login, $password);
        $stmt->execute();
        $q = $stmt->get_result()->fetch_row();
        //if user found - adding his login to the session
        if($q[0]){
            $_SESSION['login'] = $login;
            echo json_encode(array('ok' => true));
        } else{
            outputError(401);
        }
    } else {
        outputError(500);
    }
}