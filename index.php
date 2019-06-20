<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('/var/www/dev/db.php');


?>

<FORM method="POST" action="/insert.php">


    <input type="text" name="name" value="123">
    <input type="text" name="surname" value="456">
    <input type="submit" value="post">

</FORM>


<hr>


    <?php
    $select = "SELECT id, name, surname FROM blog.posts";
    $result = $connection->query($select);

    if ($result->num_rows > 0){
    ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Edit</th>
            <th><Delete/th>
        </tr>
        <?php
        while($row = $result->fetch_assoc()) {
        echo "
        <tr>
            <td>".$row["id"]."</td>
            <td>".$row["name"]."</td>
            <td>".$row["surname"]."</td>
            <td><a href='/edit.php?postid=".$row['id']."'>Edit</a></td>
            <td><a href='/delete.php?postid=".$row['id']."'>Delete</a></td>
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
        <hr>

        <FORM method="POST" action="/login.php">


            <input type="text" name="login" placeholder="login">
            <input type="text" name="password" placeholder="password">
            <input type="submit" value="Go" >

        </FORM>

        <hr>

        <FORM method="POST" action="/registration.php">


            <input type="text" name="login" placeholder="login">
            <input type="text" name="password" placeholder="password">
            <input type="submit" value="Registration">

        </FORM>