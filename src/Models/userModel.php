<?php
namespace Models;
use Models\DbModel;
class userModel extends DbModel
{
    public $table = "myapp.users";
//    public function __construct() {
//        $this->dir = './data/userModel/';
//        if (!is_dir($this->dir)) {
//            mkdir($this->dir, 0777);
//        }
//    }
}