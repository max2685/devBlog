
<?php

function insert ()
{

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once('/var/www/dev/Database.php');


    if (isset($_POST['name'])) {
        $postName = $_POST['name'];
        $postSurname = $_POST['surname'];
        $database = new Database();
        $query = "INSERT INTO blog.posts (name, surname) VALUES (:postName,:postSurname)";
        $params = ['postName' => $postName, 'postSurname' => $postSurname];
        $result = $database->prepareAndExecuteQuery($query, $params);


        if ($result === false) {
            echo $database->error;
        }
    }
}

insert();