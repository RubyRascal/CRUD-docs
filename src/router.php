<?php
require_once 'class/singleton.php';
require_once 'class/Controller.php';
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
        $id = $_GET["id"];
        $id = (int)$id;
        $routes = [
            "/users" => ["className"=>"userController", "method"=>"users"],
            "/users/create" => ["className"=>"userController", "method"=>"create"],
            "/users/edit/" => ["className"=>"userController", "method"=>"edit"],
            "/users/delete/" => ["className"=>"userController", "method"=>"delete"],
            "/docs" => ["className"=>"docController", "method"=>"docs"],
            "/docs/create" => ["className"=>"docController", "method"=>"create"],
            "/docs/edit/" => ["className"=>"docController", "method"=>"edit"],
            "/docs/delete/" => ["className"=>"docController", "method"=>"delete"],
            "/AdminPanel" => ["className"=>"adminController", "method"=>"admin"]
        ];
        $addresIsCorrect = true;
        foreach ($routes as $key => $val) {
            if ($key == $path) {
                $addresIsCorrect = false;
                $controler = new $val["className"]();
                $method = (string)$val["method"];
                $controler->$method();
                //require $val;
            }
        }
        // if ($addresIsCorrect) {
        //     require "404.php";
        // }
    }

    function getVar($name, $default = null)
    {
    }
}
