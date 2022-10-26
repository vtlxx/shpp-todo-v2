<?php
require 'setDB.php';
require 'corsHeaders.php';
require 'mysqlConfig.php';



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
    $res = mysqli_fetch_row($mysql->query("SELECT * FROM users WHERE login = \"" . $login . "\";"));
    if(isset($res[0])){
        http_response_code(400);
        echo json_encode(array('error' => 'login already exists'));
        return false;
    } else{
        //if login is not taken - adding user to the DB
        $mysql->query('INSERT INTO users SET login = "' . $login
            . '", password = "' . $password . '"');
        return true;
    }
}