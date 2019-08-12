<?php

session_start();
if (isset($_SESSION['username'])) {
    echo "You are registered";
} else {
    echo "fuck off";
}


class Database
{
    private $connection;


    //make constructor
    public function __construct()
    {
        //try contains the code that may trow an exeption
        try {
            //use variable, where create new object PDO with parameters
            $this->connection = new PDO('mysql:host=localhost;dbname=blog', 'root', 'secret');
            //cath exeption and put it in variable e
        } catch (PDOException $e) {
            //get message from it
            print "Error!: " . $e->getMessage() . "<br/>";
            //close connection
            die();
        }
    }



    public function prepareAndExecuteQuery($query, $params = array(),$fetchMode = PDO::FETCH_ASSOC)
    {
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);

            return $stmt->fetchAll($fetchMode);

    } catch (PDOException $e) {
            //get message from it
            print "Error!: " . $e->getMessage() . "<br/>";
            //close connection

        }
    }
}