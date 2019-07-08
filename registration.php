<?php

function registration()
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include('/var/www/dev/Database.php');

    if (isset($_POST['login'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $password = password_hash($password, PASSWORD_BCRYPT, ["cost" => 10]);

        $query = "INSERT INTO blog.users (login, password) VALUES (:login, :password)";
        $params = ['login' => $login, 'password' => $password];
        $database = new Database();
        $result = $database->prepareAndExecuteQuery($query, $params);


        if ($result === false) {
            echo $database->error;
        } else {
            echo "You are registered";
        }
    }
}

registration();
