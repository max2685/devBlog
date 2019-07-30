
<?php

function edit ()
{

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once('/var/www/dev/Database.php');

    $postId = $_GET['postid'];

    $database = new Database();

    if (isset($_POST['name'])) {

        $postName = $_POST['name'];
        $postSurname = $_POST['surname'];


        $query = "UPDATE blog.posts SET name = :postName, surname = :postSurname WHERE id= :postId";
        $params = ['postName' => $postName, 'postSurname' => $postSurname, 'postId' => $postId];
        $edit = $database->prepareAndExecuteQuery($query, $params);
        var_dump($edit);
        if ($edit === false) {
            echo $database->error;
        } else {
            echo "Excellent";
        }
    }

    $select = "SELECT * FROM blog.posts WHERE id = $postId";
    $result = $database->prepareAndExecuteQuery($select);
    $post = $result[0];
//var_dump($result[0]);

    echo "
    
      <form method='POST'>
      
        
        <input name='name' type='text' value = " . $post['name'] . ">
        <input name='surname' type='text' value = " . $post['surname'] . ">
     
         <input type = 'submit' >

</form>
    ";

}
edit();