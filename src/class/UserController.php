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
        }

        $model = new userModel();
        $this->result = $model->edit($_REQUEST);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->usersData = json_encode($_REQUEST, true);
            $model->save($fileUsers, $this->result);
        }

        $this->view($this->result);
    }

    public function view($result)
    {
        $view = new viewUser();
        $view->ViewFormUser($this->result);
    }

    public function delete()
    {
    $model = new userModel();
    $model->delete();
    }
}