<?php
/**
 * Created by PhpStorm.
 * User: antonije
 * Date: 1/16/19
 * Time: 9:11 PM
 */

class DB {

    public $conn;
    private $host = "localhost";
    private $db_name = "Apotheke";
    private $username = "root";
    private $password = "Antonije123!";

    function __construct()
    {
        try{
            $this->conn = new \PDO("mysql:host=".$this->host.";dbname=".$this->db_name.";charset=utf8",$this->username,$this->password);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,\PDO::FETCH_OBJ);
        }catch (\PDOException $e){
            echo $e->getMessage();
        }
    }

    function executeQuery($q){
        return $this->conn->query($q);
    }

    function prepareQ($q){
        return $this->conn->prepare($q);
    }

}