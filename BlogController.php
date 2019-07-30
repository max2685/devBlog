<?php

require_once('Database.php');

class BlogController
{

    /**
     * @var Database
     */
    private $dataBase;

    public function __construct(){
        $this->dataBase = new Database();

    }

    public function index()
    {

        $query = "SELECT id, name, surname FROM blog.posts";

        $result = $this->dataBase->prepareAndExecuteQuery($query);


        if ($result) {
            echo '
            <table class="table table-striped table-light" style="max-width: 500px">
            <!--    <thead class="thead-dark">-->
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Surname</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>

                </th>
            </tr>
            ';

            foreach ($result as $row) {
                echo "
        <tr>
            <td>" . $row["id"] . "</td>
            <td>" . $row["name"] . "</td>
            <td>" . $row["surname"] . "</td>
         
            <td><a class=\"btn btn-success\" href='/?page=blog/edit '>Edit</a></td>
            <td><a class=\"btn btn-warning\" href='/AllInOne.php?action=delete&postid=" . $row['id'] . "'>Delete</a></td>

        </tr>
        ";
            }
            echo "
    </table>
    ";
        } else {
            echo "0 results";
        }

        echo '
        <form method="POST" action="/insert.php">
            <input type="text" name="name" value="123">
            <input type="text" name="surname" value="456">
            <input type="submit" value="post">
        </form>

        <hr>

        <form method="POST" action="/login.php">
            <input type="text" name="login" placeholder="login">
            <input type="text" name="password" placeholder="password">
            <input type="submit" value="Go">
        </form>

        <hr>

        <form method="POST" action="/registration.php">
            <input type="text" name="login" placeholder="login">
            <input type="text" name="password" placeholder="password">
            <input type="submit" value="Registration">

        </form>';
    }

    public function delete()
    {
        $postId = $_GET['postid'];
        if (isset($postId)) {

            $query = "DELETE FROM blog.posts WHERE id=:postId";
            $params = ['postId' => $postId];

            $delete = $this->dataBase->prepareAndExecuteQuery($query, $params);

            if ($delete === false) {
                echo $this->dataBase->error;
            } else {
                echo "Excellent";
            }
        }
    }

    public function edit ()
    {
        $postId = $_GET['postid'];

        if (isset($_POST['name'])) {

            $postName = $_POST['name'];
            $postSurname = $_POST['surname'];

            $query = "UPDATE blog.posts SET name = :postName, surname = :postSurname WHERE id= :postId";
            $params = ['postName' => $postName, 'postSurname' => $postSurname, 'postId' => $postId];
            $edit = $this->dataBase->prepareAndExecuteQuery($query, $params);

            if ($edit === false) {
                echo $this->dataBase->error;
            } else {
                echo "Excellent";
            }
        }

        $select = "SELECT * FROM blog.posts WHERE id = $postId";
        $result = $this->dataBase->prepareAndExecuteQuery($select);
        $post = $result[0];

        echo "
    
      <form method='POST'>
      
        
        <input name='name' type='text' value = " . $post['name'] . ">
        <input name='surname' type='text' value = " . $post['surname'] . ">
     
         <input type = 'submit' >

        </form>

";
    }


    public function insert ()
    {
        if (isset($_POST['name'])) {
            $postName = $_POST['name'];
            $postSurname = $_POST['surname'];

            $query = "INSERT INTO blog.posts (name, surname) VALUES (:postName,:postSurname)";
            $params = ['postName' => $postName, 'postSurname' => $postSurname];
            $result = $this->dataBase->prepareAndExecuteQuery($query, $params);


            if ($result === false) {
                echo $this->dataBase->error;
            }
        }
    }

    public function leaveComment ()
    {
        if (isset($_POST['comment'])) {
            $comment = $_POST['comment'];
            $query = "INSERT INTO blog.comments (comment) VALUES ('$comment')";
            $result = $this->dataBase->executeQuery($query);


            if ($result === false) {
                echo $this->dataBase->error;
            }
        }
    }


    public function read()
    {
        $query = "SELECT id, name, surname FROM blog.posts";

        $result = $this->dataBase->prepareAndExecuteQuery($query);

        if ($result) {
            ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Surname</th>

                </tr>
            <?php
            foreach ($result as $row) {
                echo "
        <tr>
            <td>" . $row["id"] . "</td>
            <td>" . $row["name"] . "</td>
            <td>" . $row["surname"] . "</td>
            
        </tr>   
        ";
            }
            echo "
    </table>
    ";
        } else {
            echo "0 results";
        }
    }

}
