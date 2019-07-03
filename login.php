<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('/var/www/dev/Database.php');

$login = $_POST['login'];
$password = $_POST['password'];
$password = password_hash($password, PASSWORD_BCRYPT, ["cost" => 10]);

$query = "SELECT * FROM blog.Users WHERE 'login' = $login AND 'password' = $password";
$database = new Database();
$result = $database->executeQuery($query);


if (!$result) {

    echo "You are in !";

} else {

    echo "You are not registated";

}
