<?php
require 'setDB.php';
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
    //checking has the table exists
    if($mysql){
        if(!$mysql->query('SELECT 1 FROM `users` LIMIT 1')){
            create_users();
        }
        //checking has the login taken
        $res = mysqli_fetch_row($mysql->query("SELECT * FROM users WHERE login = \"" . $decoded_query['login'] . "\";"));
        if(isset($res[0])){
            http_response_code(400);
            echo json_encode(array('error' => 'login already exists'));
            return;
        } else{
            //if login is not taken - adding user to the DB
            $mysql->query('INSERT INTO users SET login = "' . $decoded_query['login']
                . '", password = "' . $decoded_query['pass'] . '"');
        }

        echo json_encode(array('ok' => true));
    }
}