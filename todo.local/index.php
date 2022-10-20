<?php require 'scripts.local/Router.php';

$router = new router();
$router->addRoute('addItem', 'scripts/addItem.php');
$router->addRoute('getItems', 'scripts/getItems.php');
$router->addRoute('changeItem', 'scripts/changeItem.php');
$router->addRoute('deleteItem', 'scripts/deleteItem.php');
$router->addRoute('login', 'scripts/login.php');
$router->addRoute('logout', 'scripts/logout.php');
$router->addRoute('register', 'scripts/register.php');
$router->addRoute('setDB', 'scripts/setDB.php');
$router->addRoute('index', 'http://ToDov3/index.html');

$router->route(key($_GET));
