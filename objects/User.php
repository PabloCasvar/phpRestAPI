<?php 
class User{
    private $conn;
    private $table_name = "users";

    //properties
    public $username;
    private $password;

    public fuNction __construct($db){
        $this->conn = $db;
    }

    function readAll(){
        $query = "SELECT username FROM "
                 .$this->table_name;
        
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }

    function getPassword($username){
        $query = "SELECT password FROM "
                .$this->table_name 
                ." WHERE username='"
                .$username
                ."'";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }
}

?>