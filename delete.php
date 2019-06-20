<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('/var/www/dev/db.php');

$postId = $_GET['postid'];

if (isset($_GET['postid'])) {

    $postDelete = mysqli_query($connection, "DELETE FROM blog.posts WHERE id= $postId");


    if ($postDelete === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $connection->error;

    }
}