<?php session_start();
require 'corsHeaders.php';

unset($_SESSION['login']);
session_destroy();

echo json_encode(array('ok' => true));
