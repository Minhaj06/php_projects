<?php

$server = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'php_crud';

$conn = mysqli_connect($server, $db_user, $db_pass, $db_name);

if (!$conn) {
    echo "<h1>Database connection failure!</h1>";
}

session_start();