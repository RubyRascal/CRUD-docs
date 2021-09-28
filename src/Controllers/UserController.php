<?php
namespace Controllers;
use Models\userModel;
use Views\viewListUser;
use Views\viewUser;
use Validators\UserValidator;
class UserController
{
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
            $result=$model->create($userData);
            var_dump($result);
            $validate = UserValidator::validateForm($result);
        }

        if ($validate["result"]["correct"]){
            $model->save($validate);
            header('Location: /users');
        }else{
            $this->view($validate["result"], $validate["errors"]);
        }
    }

    public function edit()
    {
        $model = new \Models\userModel();
        $result = $model->edit();

        $userData = array(
            'login' => $result["FromFile"]["login"],
            'firstName' => $result["FromFile"]["firstName"],
            'lastName' => $result["FromFile"]["lastName"],
            'birthday' => $result["FromFile"]["birthday"],
            'active' => $result["FromFile"]["active"]
        );

        $validate = UserValidator::validateForm($result["ToEdit"]);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $validate["result"]["correct"]) {
            $updateUser = json_encode($result["ToEdit"], true);
            $model->save($validate, $_GET["id"]);
            header('Location: /users');
        }elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $validate["result"]["correct"] == false) {
            $this->view($result["ToEdit"], $validate["errors"]);
        }else{
            $this->view($userData, $validate["errors"]);
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
    $model->delete();
    header('Location: /users');
    }
}