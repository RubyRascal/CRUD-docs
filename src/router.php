<?php
require_once 'class/singleton.php';
require_once 'class/AdminController.php';
require_once 'class/UserController.php';
require_once 'class/DocController.php';

class Router extends Singleton
{

    public $userControl;
    public $docControl;

    public function getPathUser()
    {
        $tmpArr = array();
        parse_str($_SERVER['REQUEST_URI'], $tmpArr);
        $path = array_key_first($tmpArr);
        $containPathUser = strstr($path, "/users");
        $containPathDoc = strstr($path, "/docs"); //
        //
        if ($containPathUser == true) {
            $this->userControl = new UserController();
        } elseif ($containPathDoc == true) {
            $this->docControl = new DocController();
        }

        $posId = strpos($path, "?");
        if ($posId > 0) {
            $path = substr($path, 0, $posId);
        }
        return $path;
    }

    public function run()
    {
        //Выбор какой контроллер запустить и его запуск
        $path = $this->getPathUser();
        $routes = [
            "/users" => ["className"=>"UserController", "method"=>"users"],
            "/users/create" => ["className"=>"UserController", "method"=>"create"],
            "/users/edit/" => ["className"=>"UserController", "method"=>"edit"],
            "/users/delete/" => ["className"=>"UserController", "method"=>"delete"],
            "/docs" => ["className"=>"DocController", "method"=>"docs"],
            "/docs/create" => ["className"=>"DocController", "method"=>"create"],
            "/docs/edit/" => ["className"=>"DocController", "method"=>"edit"],
            "/docs/delete/" => ["className"=>"DocController", "method"=>"delete"],
            "/AdminPanel" => ["className"=>"adminController", "method"=>"admin"]
        ];
        $addresIsCorrect = true;
        foreach ($routes as $key => $val) {
            if ($key == $path) {
                $addresIsCorrect = false;
                $controler = new $val["className"]();
                $method = (string)$val["method"];
                $controler->$method();
            }
        }
         if ($addresIsCorrect) {
             require "404.php";
         }
    }

    function getVar($name, $default = null)
    {
    }
}
