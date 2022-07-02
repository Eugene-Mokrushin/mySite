<?php

$db_host = 'localhost:3306';
$db_user = ' root';
$db_pass = ' ';
$db_name = 'users';

try{
    $db = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo $e->getMessage();
}
?>