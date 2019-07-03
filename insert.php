
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('/var/www/dev/Database.php');


if (isset($_POST['name'])) {
    $postsName = $_POST['name'];
    $postSurname = $_POST['surname'];

    $query = "INSERT INTO blog.posts (name, surname) VALUES ('$postsName','$postSurname')";
    $database = new Database();
    $result = $database->executeQuery($query);


    if($result === false){
        echo $database->error;
    }
}
