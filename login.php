<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('/var/www/dev/db.php');

$login = $_POST['login'];
$password = $_POST['password'];

$password = password_hash($password, PASSWORD_BCRYPT, ["cost" => 10]);

$log = mysqli_query($connection, "SELECT * FROM blog.Users WHERE 'login' = $login AND 'password' = $password");

if (!$log || mysqli_num_rows($log) == 0) {

    echo "You are in !";

} else {

    echo "You are not registated";

}
