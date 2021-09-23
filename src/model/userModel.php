<?php
class userModel
{
    public $loginErr;
    public $firstNameErr;
    public $lastNameErr;
    public $birthdayErr;
    public function sayHello()
    {
        echo "Hello user";
    }

    public function edit()
    {
        if (isset($_GET["id"])) {
            $dir = '/var/www/data/users/';
            $fileUsers = $dir . $_GET["id"] . '.json';
            $readFile = file_get_contents($fileUsers);
            $usersData = json_decode($readFile, true);    
        }
        var_dump($usersData);
        
        $userData = array(
            'login' => $usersData["login"],
            'firstName' => $usersData["firstName"],
            'lastName' => $usersData["lastName"],
            'birthday' => $usersData["date"],
            'active' => $usersData["active"]
        );
        
        
        $formIsCorrect = true;
        
        if (empty($userData["login"])) {
            $this->loginErr = "Введите логин.";
            $formIsCorrect = false;
        } else {
            if (strlen($userData["login"]) < 8) {
                $this->loginErr = "Логин должен быть минимум 8 символов.";
                $formIsCorrect = false;
            }
        }
        
        if (empty($userData["firstName"])) {
            $this->firstNameErr = "Введите имя.";
            $formIsCorrect = false;
        } else {
            if (strlen($userData["firstName"]) < 4) {
                $this->firstNameErr = "Имя должно быть не менее 4 символов.";
                $formIsCorrect = false;
            }
        }
        
        if (empty($userData["lastName"])) {
            $this->lastNameErr = "Введите фамилию.";
            $formIsCorrect = false;
        } else {
            if (strlen($userData["lastName"]) < 6) {
                $this->lastNameErr = "Фамилия должна быть не менее 6 символов.";
                $formIsCorrect = false;
            }
        }
        
        if (empty($userData["birthday"])) {
            $this->birthdayErr = "Введите дату.";
            $formIsCorrect = false;
        }
        
        if ($formIsCorrect) { 
            $json_string = json_encode($userData);
            file_put_contents($fileUsers, $json_string);
            header('Location: /users');
            exit;
        }
        return $userData;
        
    }

    public function create()
    {
        if(isset($_POST["submitCreate"])){
            $i = 1;
            $fileUsers = 'data/users/' . $i . '.json';
            while (is_file($fileUsers)) {
                $fileUsers = 'data/users/' . $i++ . '.json';
            }
        }
        $userData = array(
            'login' => $_POST["login"],
            'firstName' => $_POST["firstName"],
            'lastName' => $_POST["lastName"],
            'birthday' => $_POST["date"],
            'active' => $_POST["active"]
        );
        
        $formIsCorrect = true;
        
        if (empty($userData["login"])) {
            $loginErr = "Введите логин.";
            $formIsCorrect = false;
        } else {
            if (strlen($userData["login"]) < 8) {
                $loginErr = "Логин должен быть минимум 8 символов.";
                $formIsCorrect = false;
            }
        }
        
        if (empty($userData["firstName"])) {
            $firstNameErr = "Введите имя.";
            $formIsCorrect = false;
        } else {
            if (strlen($userData["firstName"]) < 4) {
                $firstNameErr = "Имя должно быть не менее 4 символов.";
                $formIsCorrect = false;
            }
        }
        
        if (empty($userData["lastName"])) {
            $lastNameErr = "Введите фамилию.";
            $formIsCorrect = false;
        } else {
            if (strlen($userData["lastName"]) < 6) {
                $lastNameErr = "Фамилия должна быть не менее 6 символов.";
                $formIsCorrect = false;
            }
        }
        
        if (empty($userData["birthday"])) {
            $birthdayErr = "Введите дату.";
            $formIsCorrect = false;
        }
        
        if ($formIsCorrect) { 
            $json_string = json_encode($userData);
            file_put_contents($fileUsers, $json_string);
            header('Location: /users');
            exit;
        }
    }
}