<?php
require_once 'Controller.php';
require 'model/userModel.php';
require 'view/viewUser.php';
class UserController extends Controller
{
    public $loginErr;
    public $firstNameErr;
    public $lastNameErr;
    public $birthdayErr;
    public $usersData;
    public $result;

    public function users()
    {
        require_once 'view/listUsers.php';
    }
    public function create()
    {
        if(isset($_POST["submitCreate"])){
            $i = 1;
//            $fileUsers = 'data/users/' . $i . '.json';
//            while (is_file($fileUsers)) {
//                $fileUsers = 'data/users/' . $i++ . '.json';
//            }
            $model = new userModel();
            $this->result=$model->create();
            $model->save($i, $this->result);
        }

        $this->view($this->result);
    }

    public function edit()
    {
        if (isset($_GET["id"])) {
            $dir = '/var/www/data/users/';
            $fileUsers = $dir . $_GET["id"] . '.json';
            $readFile = file_get_contents($fileUsers);
            $this->usersData = json_decode($readFile, true);
        }
        $model = new userModel();
        $this->result = $model->edit($this->usersData);
        $model->save($fileUsers, $this->result);

//        if ($this->result["correct"]) {
//            $json_string = json_encode($this->result);
//            file_put_contents($fileUsers, $json_string);
//            var_dump($fileUsers);
//            //header('Location: /users');
//        }

        $this->view($this->result);
    }

    public function view($result)
    {
        $view = new viewUser();
        $view->ViewFormUser($this->result);
    }
}