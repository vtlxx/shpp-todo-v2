<?php
$routes = [];
$scripts_host = '';
addRoute('addItem', $scripts_host . 'scripts/addItem.php');
addRoute('getItems', $scripts_host . 'scripts/getItems.php');
addRoute('changeItem', $scripts_host . 'scripts/changeItem.php');
addRoute('deleteItem', $scripts_host . 'scripts/deleteItem.php');
addRoute('login', $scripts_host . 'scripts/login.php');
addRoute('logout', $scripts_host . 'scripts/logout.php');
addRoute('register', $scripts_host . 'scripts/register.php');
addRoute('setDB', $scripts_host . 'scripts/setDB.php');
addRoute('index', $scripts_host . 'ToDov3/index.html');

route($_GET['action']);
//./route.php?action=login     ['login' => 'user', 'pass' = 'pass']

function addRoute($name, $path){
    global $routes;
    $routes[$name] = $path;
}

function route($uri){
    global $routes;
    $action = trim($uri, '/');
    require($routes[$action]);
}
?>