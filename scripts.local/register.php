<?php
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

    $mysql = mysqli_connect('localhost', 'root', '', $base_name);
    if($mysql){
        $val = $mysql->query('SELECT 1 FROM `users` LIMIT 1');
        if(!$val){
            $query = 'CREATE TABLE users (login VARCHAR(20) KEY, password VARCHAR(18))';
            $mysql->query($query);
        }

        $check_login = $mysql->query('SELECT FROM users WHERE login = ' . $decoded_query['login']);
        if($check_login){
            //TODO: if login already taken
        } else{
            $mysql->query('INSERT INTO users SET login = "' . $decoded_query['login']
                . '", password = "' . $decoded_query['pass'] . '"');
        }

        echo json_encode(array('ok' => true));
    }
}