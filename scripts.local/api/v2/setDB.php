<?php
function create_items(){
    //creating 'items' table
    $mysql = mysqli_connect('localhost', 'root', '', 'todo');
    $query = 'CREATE TABLE items (id INT AUTO_INCREMENT KEY, text VARCHAR(120), checked VARCHAR(6), user_id VARCHAR(20));';
    return $mysql->query($query);
}

function create_users(){
    //creating 'users' table
    $mysql = mysqli_connect('localhost', 'root', '', 'todo');
    $query = 'CREATE TABLE users (login VARCHAR(20) KEY, password VARCHAR(18))';
    return $mysql->query($query);
}

