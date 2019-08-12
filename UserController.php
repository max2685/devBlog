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
        $password = md5($password);

        $query = "SELECT * FROM blog.users WHERE login = :login AND password = :password";

        $params = [':login' => $login, ':password' => $password];

        $result = $this->dataBase->prepareAndExecuteQuery($query, $params);

        var_dump($result);
        if (!$result) {

            echo "Password or login are incorrect";
        } else {
            $_SESSION['username'] = $login ;
            echo "You have logged in";
        }
    }

    public function registration()
    {
        if (isset($_POST['login'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $password = md5($password);

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