<?php
require_once 'connection.php';
session_start();
if (isset($_COOKIE['guid'])) {
    $id = $_SESSION['user']['id'];
    $conn_add_guid = mysqli_connect("localhost:3306", " root", " ", "users");
    $select_stmt = $db->prepare("SELECT * from users WHERE id = :id LIMIT 1");
    $select_stmt->execute([
        ':id' => $id
    ]);
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
    setcookie('guid', $row['guid_w'], time()-3600*365, '/');
    $sql_add_guid = ("UPDATE users SET guid_w = NULL WHERE id = $id");
    $conn_add_guid = mysqli_connect("localhost:3306", " root", " ", "users");
    mysqli_query($conn_add_guid, $sql_add_guid);
}  
session_destroy();
header('location: index.php');
exit()
?>