<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('/var/www/dev/Database.php');

$query = "SELECT id, name, surname FROM blog.posts";
$database = new Database();
$result = $database->executeQuery($query);

if ($result){
?>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Surname</th>

    </tr>
    <?php
    foreach($result as $row){
        echo "
        <tr>
            <td>".$row["id"]."</td>
            <td>".$row["name"]."</td>
            <td>".$row["surname"]."</td>
            
        </tr>   
        ";
    }
    echo "
    </table>
    ";
    } else {
        echo "0 results";
    }
    ?>
