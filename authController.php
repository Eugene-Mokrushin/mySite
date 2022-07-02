<?php 

session_start();

if (isset($_POST['submit_btn'])) {
    $password = strip_tags($_POST['new-pass']);
    $password_repeat = strip_tags($_POST['repeat-new-pass']);


    if (strlen($password) < 6) {
        $errorMsg[0][] = 'Must be at least 6 characters';
    }

    if ($password_repeat != $password) {
        $errorMsg[1][] = 'Passwords are different';
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $email = $_SESSION['email_address'];

    if (empty($errorMsg)) {
        $sql_update_pass = "UPDATE users SET password='$hashed_password' WHERE email='$email'";
        $conn_users = mysqli_connect("localhost:3306", "root", "", "users"); 
        $result = mysqli_query($conn_users, $sql_update_pass);
        if ($result) {
            header("location: login.php");
            exit(0);
        }
    }
}


?>