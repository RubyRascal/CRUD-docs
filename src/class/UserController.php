<?php
require_once 'model/userModel.php';
require_once 'func_users.php';
require_once 'view/viewListUser.php';
require_once 'view/viewUser.php';
class UserController
{
    public function users()
    {
        $view = new viewListUser();
        $view->ViewList();
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

        $errors = array();

        if(isset($_POST["submitCreate"])){

            $model = new userModel();
            $result=$model->create($userData);
            $formIsCorrect = true;

            if (empty($result["login"])) {
                $loginErr = "Введите логин.";
                $formIsCorrect = false;
            } else {
                if (strlen($result["login"]) < 8) {
                    $loginErr = "Логин должен быть минимум 8 символов.";
                    $formIsCorrect = false;
                }
            }

            if (empty($result["firstName"])) {
                $firstNameErr = "Введите имя.";
                $formIsCorrect = false;
            } else {
                if (strlen($result["firstName"]) < 4) {
                    $firstNameErr = "Имя должно быть не менее 4 символов.";
                    $formIsCorrect = false;
                }
            }

            if (empty($result["lastName"])) {
                $lastNameErr = "Введите фамилию.";
                $formIsCorrect = false;
            } else {
                if (strlen($result["lastName"]) < 6) {
                    $lastNameErr = "Фамилия должна быть не менее 6 символов.";
                    $formIsCorrect = false;
                }
            }

            if (empty($result["birthday"])) {
                $birthdayErr = "Введите дату.";
                $formIsCorrect = false;
            }

            $errors = array(
                "loginErr" => $loginErr,
                "firstNameErr" => $firstNameErr,
                "lastNameErr" => $lastNameErr,
                "birthdayErr" => $birthdayErr
            );
            $result["correct"] = $formIsCorrect;
        }
        if ($formIsCorrect){
            $model->save($result, $_GET["id"]);
        }else{
            $this->view($result, $errors);//возможно $this
        }
    }

    public function edit()
    {
        // при редактировании если какое то поле заполнено не верно,
        // то возвращает не введенные пользователем значения, а значения из файла.
        if (isset($_GET["id"])) {
            $dir = '/var/www/data/users/';
            $fileUsers = $dir . $_GET["id"] . '.json';
            $readFile = file_get_contents($fileUsers);
            $userArr = json_decode($readFile, true);
        }

        $userData = array(
            'login' => $userArr["login"],
            'firstName' => $userArr["firstName"],
            'lastName' => $userArr["lastName"],
            'birthday' => $userArr["birthday"],
            'active' => $userArr["active"]
        );

        $errors = array();

        $model = new userModel();
        $result = $model->edit($_REQUEST);

        $formIsCorrect = true;

        if (empty($result["login"])) {
            $loginErr = "Введите логин.";
            $formIsCorrect = false;
        } else {
            if (strlen($result["login"]) < 8) {
                $loginErr = "Логин должен быть минимум 8 символов.";
                $formIsCorrect = false;
            }
        }

        if (empty($result["firstName"])) {
            $firstNameErr = "Введите имя.";
            $formIsCorrect = false;
        } else {
            if (strlen($result["firstName"]) < 4) {
                $firstNameErr = "Имя должно быть не менее 4 символов.";
                $formIsCorrect = false;
            }
        }

        if (empty($result["lastName"])) {
            $lastNameErr = "Введите фамилию.";
            $formIsCorrect = false;
        } else {
            if (strlen($result["lastName"]) < 6) {
                $lastNameErr = "Фамилия должна быть не менее 6 символов.";
                $formIsCorrect = false;
            }
        }

        if (empty($result["birthday"])) {
            $birthdayErr = "Введите дату.";
            $formIsCorrect = false;
        }

        $errors = array(
            "loginErr" => $loginErr,
            "firstNameErr" => $firstNameErr,
            "lastNameErr" => $lastNameErr,
            "birthdayErr" => $birthdayErr
        );

        $result["correct"] = $formIsCorrect;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $result["correct"]) {
            $updateUser = json_encode($_REQUEST, true);
            $model->save($result, $_GET["id"]);
        }elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $result["correct"] == false) {
            $this->view($_REQUEST, $errors);
        }else{
            $this->view($userData, $errors);
        }
    }

    public function view($result, $errors)
    {
        $view = new viewUser();
        $view->ViewFormUser($result, $errors);
    }



    public function delete()
    {
    $model = new userModel();
    $model->delete();
    }
}