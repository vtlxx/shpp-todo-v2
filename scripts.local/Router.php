<?php require 'scripts/corsHeaders.php';

class Router
{
    private $scripts = array();

    function addRoute($name, $path){
        $this->scripts[$name] = $path;
    }

    function route($name){
        $address = $this->scripts[$name];
        if(file_exists($address)){
            require $address;
        } else {
            require "404.php";
            die();
        }
    }
}