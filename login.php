<?php

function login()
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include('/var/www/dev/Database.php');

    $login = $_POST['login'];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_BCRYPT, ["cost" => 10]);

    $query = "SELECT * FROM blog.Users WHERE 'login' = :login AND 'password' = :password";
    $params = ['login' => $login, 'password' => $password];
    $database = new Database();
    $result = $database->prepareAndExecuteQuery($query, $params);


    if (!$result) {

        echo "You are not registated";

    } else {

        echo "You are in";

    }
}

login();
