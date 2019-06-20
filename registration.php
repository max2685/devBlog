<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('/var/www/dev/db.php');

if (isset($_POST['login'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_BCRYPT, ["cost" => 10]);
    $query = "INSERT INTO blog.users (login, password) VALUES ('$login','$password');";
    echo $query;
    $user = mysqli_query($connection, $query);
    var_dump($user);
    if ($user === false) {
        echo $connection->error;
    }else{
        echo "You are registered";
    }
}
