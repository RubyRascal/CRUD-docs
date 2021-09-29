<?php
namespace Controllers;
use Models\DbAdapter;
use Models\userModel;
use Views\viewListUser;
use Views\viewUser;
use Validators\UserValidator;
class UserController
{
    public $connect;
    public $insert;
    public $sth;
    public function users()
    {
        $model = new \Models\userModel();
        $view = new \Views\viewListUser();
        $view->ViewList($model->list());
    }

    public function create()
    {
        $userData = array(
            'login' => $_POST["login"],
            'firstName' => $_POST["firstName"],
            'lastName' => $_POST["lastName"],
            'birthday' => $_POST["birthday"],
            'active' => $_POST["active"]
        );

        if(isset($_POST["submitCreate"])){
            $model = new \Models\userModel();
            $validate = UserValidator::validateForm($userData);
            $model->create($validate["result"]);
        }

        if ($validate["result"]["correct"]){
          header('Location: /users');
        }else{
            $this->view($validate["result"], $validate["errors"]);
        }
    }

    public function edit()
    {
        $model = new \Models\userModel();
        $query = "SELECT * FROM myapp.users WHERE user_id={$_GET["id"]}";
        $db = DBAdapter::getInstance();
        $conn = $db->getConnect();
        $resultExec = $db->execSQL($query);

        while ($row = mysqli_fetch_assoc($resultExec)){
            $data = $row;
        }
        if (count($_POST) ==0){
            $userData = array(
                'login' => $data["login"],
                'firstName' => $data["firstName"],
                'lastName' => $data["lastName"],
                'birthday' => $data["birthday"],
                'active' => $data["active"]
            );
            $this->view($userData, $validate["errors"]);
        }
        $result = $model->edit($_GET["id"], $_POST);

        $validate = UserValidator::validateForm($result);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $validate["result"]["correct"]) {
            header('Location: /users');
        }elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $validate["result"]["correct"] == false) {
            $this->view($validate["result"], $validate["errors"]);
        }
    }

    public function view($result, $errors)
    {
        $view = new \Views\viewUser();
        $view->ViewFormUser($result, $errors);
    }

    public function delete()
    {
    $model = new \Models\userModel();
    $model->delete($_GET["id"]);
    header('Location: /users');
    }
}