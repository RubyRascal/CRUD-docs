<?php
namespace Models;
class docModel extends Model
{
    public function __construct() {
        $this->dir = './data/docModel/';
        if (!is_dir($this->dir)) {
            mkdir($this->dir, 0777);
        }
    }
}