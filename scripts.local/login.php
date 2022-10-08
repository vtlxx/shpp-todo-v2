<?php
session_start();

$base_name = 'todo';
$http_url = 'http://todo.local';


header('Access-Control-Allow-Origin: ' . $http_url);
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //decoding query
    $decoded_query = json_decode(file_get_contents('php://input'), true);
    //checking has session started
    login($base_name, $decoded_query['login'], $decoded_query['pass']);
    file_put_contents('log.txt', session_id());
}

function login($base_name, $login, $password){
    $mysql = mysqli_connect('localhost', 'root', '', $base_name);
    if($mysql){
        $val = $mysql->query('SELECT 1 FROM `users` LIMIT 1');
        if($val){
            $q = mysqli_fetch_row($mysql->query('SELECT COUNT(1) FROM users WHERE login = "' . $login
                . '" AND password = "' . $password . '";'));
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
}