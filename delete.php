<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('/var/www/dev/db.php');

$postId = $_GET['postid'];

if (isset($_GET['postid'])) {

    $query = "DELETE FROM blog.posts WHERE id= $postId";
    $database = new Database();
    $result = $database->executeQuery($query);


    if ($result === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $database->error;

    }
}