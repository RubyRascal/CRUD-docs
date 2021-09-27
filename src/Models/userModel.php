<?php
namespace Models;
class userModel extends Model
{
    public function __construct() {
        $this->dir = './data/userModel/';
        if (!is_dir($this->dir)) {
            mkdir($this->dir, 0777);
        }
    }
}