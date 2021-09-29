<?php

namespace Models;

use Core\Singleton;
use mysqli;
class DbAdapter extends Singleton
{
    public $mysqli_connect = null;
    public $servername = "db";
    public $username = "root";
    public $password = "root";
    public $database = "myapp";
    public $instance;

    public function __construct()
    {
        $this->mysqli_connect = mysqli_connect($this->servername, $this->username, $this->password, $this->database);

        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
    }

    public function getConnect()
    {
        return $this->mysqli_connect;
    }

    public function execSQL(string $sql)
    {
        $this->instance = DbAdapter::getInstance();
        $connect = $this->instance->getConnect();
        $result = mysqli_query($connect ,$sql);
        return $result;
    }
}