
<?php



class AllInOne {

    public function __construct(){

        include('/var/www/dev/Database.php');

    }

  public  function delete ()
    {

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $postId = $_GET['postid'];
        var_dump($postId);
        if (isset($postId)) {

            $query = "DELETE FROM blog.posts WHERE id=:postId";
            $params = ['postId' => $postId];
            var_dump($params);
            $database = new Database();
            $delete = $database->prepareAndExecuteQuery($query, $params);
            var_dump($delete);
            if ($delete === false) {
                echo $database->error;
            } else {
                echo "Excellent";
            }
        }
    }

    public function edit ()
    {

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

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

        echo "
    
      <form method='POST'>
      
        
        <input name='name' type='text' value = " . $post['name'] . ">
        <input name='surname' type='text' value = " . $post['surname'] . ">
     
         <input type = 'submit' >

</form>

";}


    public function insert ()
    {

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

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

    public function leaveComment ()
    {

        if (isset($_POST['comment'])) {
            $comment = $_POST['comment'];

            $database = new Database();
            $query = "INSERT INTO blog.comments (comment) VALUES ('$comment')";
            $result = $database->executeQuery($query);


            if ($result === false) {
                echo $database->error;
            }
        }
    }

    public function login()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $login = $_POST['login'];
        $password = $_POST['password'];
        $password = password_hash($password, PASSWORD_BCRYPT, ["cost" => 10]);

        $database = new Database();
        $query = "SELECT * FROM blog.Users WHERE 'login' = :login AND 'password' = :password";
        $params = ['login' => $login, 'password' => $password];
        $result = $database->prepareAndExecuteQuery($query, $params);


        if (!$result) {

            echo "You are not registated";

        } else {

            echo "You are in";

        }
    }

    public function read()
    {

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $database = new Database();

        $query = "SELECT id, name, surname FROM blog.posts";

        $result = $database->prepareAndExecuteQuery($query);

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


    public function registration()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        if (isset($_POST['login'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $password = password_hash($password, PASSWORD_BCRYPT, ["cost" => 10]);

            $query = "INSERT INTO blog.users (login, password) VALUES (:login, :password)";
            $params = ['login' => $login, 'password' => $password];
            $database = new Database();
            $result = $database->prepareAndExecuteQuery($query, $params);


            if ($result === false) {
                echo $database->error;
            } else {
                echo "You are registered";
            }
        }
    }


}