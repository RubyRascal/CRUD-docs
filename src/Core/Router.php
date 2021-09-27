<?php
namespace Core;
use Controllers\UserController;
use Controllers\DocController;
use Controllers\AdminController;

class Router extends \Core\Singleton
{

    public $userControl;
    public $docControl;
    public $adminControl;

    public function getPathUser()
    {
        $tmpArr = array();
        parse_str($_SERVER['REQUEST_URI'], $tmpArr);
        $path = array_key_first($tmpArr);
        $containPathUser = strstr($path, "/users");
        $containPathDoc = strstr($path, "/docs");
        $containPathAdmin = strstr($path, "/AdminPanel");

        if ($containPathUser == true) {
            $this->userControl = new \Controllers\UserController();
        } elseif ($containPathDoc == true) {
            $this->docControl = new \Controllers\DocController();
        }elseif ($containPathAdmin == true) {
            $this->adminControl = new \Controllers\AdminController();
        }

        $posId = strpos($path, "?");
        if ($posId > 0) {
            $path = substr($path, 0, $posId);
        }
        return $path;
    }

    public function run()
    {
        $path = $this->getPathUser();
        $routes = [
            "/users" => ["className"=>UserController::class, "method"=>"users"],
            "/users/create" => ["className"=>UserController::class, "method"=>"create"],
            "/users/edit/" => ["className"=>UserController::class, "method"=>"edit"],
            "/users/delete/" => ["className"=>UserController::class, "method"=>"delete"],
            "/docs" => ["className"=>DocController::class, "method"=>"docs"],
            "/docs/create" => ["className"=>DocController::class, "method"=>"create"],
            "/docs/edit/" => ["className"=>DocController::class, "method"=>"edit"],
            "/docs/delete/" => ["className"=>DocController::class, "method"=>"delete"],
            "/AdminPanel" => ["className"=>AdminController::class, "method"=>"admin"],
            "/" => ["className"=>AdminController::class, "method"=>"admin"]
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
}
