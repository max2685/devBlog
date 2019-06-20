<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('/var/www/dev/db.php');

$postId = $_GET['postid'];

if (isset($_POST['name'])) {

    $postName = $_POST['name'];
    $postSurname = $_POST['surname'];
    $post = mysqli_query($connection, "UPDATE blog.posts SET name = $postName, surname = $postSurname WHERE id= $postId");
}

$select = "SELECT * FROM blog.posts WHERE id = $postId";
$result = $connection->query($select)->fetch_assoc();

    echo $connection->error;
    echo "
    
      <FORM method='POST'>
        
        <input name='name' type='text' value = " . $result['name'] . ">
        <input name='surname' type='text' value = " . $result['surname'] . ">
     
         <input type = 'submit' >

</FORM >
    ";


