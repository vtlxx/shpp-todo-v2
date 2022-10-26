<?php
$routes = [];
addRoute('addItem', 'api/v2/addItem.php');
addRoute('getItems', 'api/v2/getItems.php');
addRoute('changeItem', 'api/v2/changeItem.php');
addRoute('deleteItem', 'api/v2/deleteItem.php');
addRoute('login', 'api/v2/login.php');
addRoute('logout', 'api/v2/logout.php');
addRoute('register', 'api/v2/register.php');
addRoute('setDB', 'api/v2/setDB.php');
addRoute('index', 'api/v2/index.html');

route($_GET['action']);

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