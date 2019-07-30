<?php

function delete ()
{

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once('/var/www/dev/Database.php');

    $postId = $_GET['postid'];
    if (isset($postId)) {

        $query = "DELETE FROM blog.posts WHERE id=:postId";
        $params = ['postId' => $postId];
        $database = new Database();
        $delete = $database->prepareAndExecuteQuery($query, $params);

        if ($delete === false) {
            echo $database->error;
        } else {
            echo "Excellent";
        }
    }
}
delete();