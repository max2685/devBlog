<?php

require_once('Database.php');

class UserController
{
    private $dataBase;

    public function __construct()
    {
        $this->dataBase = new Database();

    }

    public function login()
    {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $password = password_hash($password, PASSWORD_BCRYPT, ["cost" => 10]);

        $query = "SELECT * FROM blog.Users WHERE 'login' = :login AND 'password' = :password";
        $params = ['login' => $login, 'password' => $password];
        $result = $this->dataBase->prepareAndExecuteQuery($query, $params);


        if (!$result) {
            echo "You are not registated";
        } else {
            echo "You are in";
        }
    }

    public function registration()
    {
        if (isset($_POST['login'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $password = password_hash($password, PASSWORD_BCRYPT, ["cost" => 10]);

            $query = "INSERT INTO blog.users (login, password) VALUES (:login, :password)";
            $params = ['login' => $login, 'password' => $password];
            $result = $this->dataBase->prepareAndExecuteQuery($query, $params);

            if ($result === false) {
                echo $this->dataBase->error;
            } else {
                echo "You are registered";
            }
        }
    }


}