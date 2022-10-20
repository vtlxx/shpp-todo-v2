<?php
session_start();
require 'corsHeaders.php';
require 'mysqlConfig.php';


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //decoding query
    $decoded_query = json_decode(file_get_contents('php://input'), true);
    //checking has login correct
    login($decoded_query['login'], $decoded_query['pass']);
    file_put_contents('log.txt', session_id());
}

function login($login, $password){
    $mysql = database_connect();
    $val = $mysql->query('SELECT 1 FROM `users` LIMIT 1');
    //if table 'users' exists
    if($val){
        //searching for user with $login and $password
        $q = mysqli_fetch_row($mysql->query('SELECT COUNT(1) FROM users WHERE login = "' . $login
            . '" AND password = "' . $password . '";'));
        //if user found - adding his login to the session
        if($q[0]){
            $_SESSION['login'] = $login;
            echo json_encode(array('ok' => true));
        } else{
            echo json_encode(array('error' => 'incorrect login or password'));
        }
    } else {
        echo json_encode(array('error' => 'table does not exist'));
    }
}