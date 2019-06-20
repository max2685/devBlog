<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ('/var/www/dev/db.php');

$select = "SELECT id, name, surname FROM blog.posts";
$result = $connection->query($select);

if ($result->num_rows > 0){
    echo "<table><tr><th>ID</th><th>Name</th><th>Surname</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["surname"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

