<?php

namespace Models;

use Core\Singleton;
use PDO;
use PDOException;

class DbAdapter extends Singleton
{
    public $conn;
    public $servername;
    public $username;
    public $password;
//    public $schema;
    public function __construct()
    {
//        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
//        $mysqli = new mysqli("db", "root", "root", "myapp");
        try{
            $this->servername = "db";
            $this->username = "root";
            $this->password = "root";
//        $this->schema ="myapp";

            $this->conn = new PDO('mysql:host=db;dbname=myapp', $this->username, $this->password);
        }catch (PDOException $e){
            print "Error!:" . $e->getMessage() . "<br/>";
        }

    }

    public function getConnect()
    {
        return $this->conn;
    }

//    public function execSQL(string $sql)
//    {
//        $instance = self::getInstance();
//        $result = mysqli_query($instance->getConnect(), $sql);
//        return $result;
//    }
}