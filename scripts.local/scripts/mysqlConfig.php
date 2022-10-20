<?php
const DATABASE_HOST = 'localhost';
const DATABASE_NAME = 'todo';
const DATABASE_USERNAME = 'root';
const DATABASE_PASSWORD = '';

/**
 * Connecting to the database and setting charset to 'utf8'
 *
 * @return false|mysqli
 */
function database_connect(){
    $mysql = mysqli_connect(DATABASE_HOST, DATABASE_USERNAME,
        DATABASE_PASSWORD, DATABASE_NAME);
    if($mysql){
        $mysql->set_charset('utf8');
    }

    return $mysql;
}
