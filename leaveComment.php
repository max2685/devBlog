<?php
include('/var/www/dev/Database.php');


if (isset($_POST['comment'])) {
    $comment = $_POST['comment'];

    $query = "INSERT INTO blog.comments (comment) VALUES ('$comment')";
    $database = new Database();
    $result = $database->executeQuery($query);


    if($result === false){
        echo $database->error;
    }
}
