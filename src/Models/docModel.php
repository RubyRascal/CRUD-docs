<?php
namespace Models;
use Models\DbModel;
class docModel extends DbModel
{
    public $table = "myapp.docs";
//    public function __construct() {
//        $this->dir = './data/docModel/';
//        if (!is_dir($this->dir)) {
//            mkdir($this->dir, 0777);
//        }
//    }
}