<?php
require_once('/var/www/dev/Database.php');

function leaveComment ()
{

    if (isset($_POST['comment'])) {
        $comment = $_POST['comment'];

        $query = "INSERT INTO blog.comments (comment) VALUES ('$comment')";
        $database = new Database();
        $result = $database->executeQuery($query);


        if ($result === false) {
            echo $database->error;
        }
    }
}

leaveComment();