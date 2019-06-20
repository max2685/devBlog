
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ('/var/www/dev/db.php');

if (isset($_POST['name'])) {
    $postsName = $_POST['name'];
    $postSurname = $_POST['surname'];
    $post = mysqli_query($connection, "INSERT INTO blog.posts (name, surname) VALUES ('$postsName','$postSurname');");

    if($post === false){
        echo $connection->error;
    }
}
