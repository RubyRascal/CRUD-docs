<?php
namespace Views;
class viewUser
{
    public function ViewFormUser($userData, $errors)
    {
        // сделать функцию render("принимает имя файла", $массив данных) и сделать класс View extends Singleton
        require 'formUser.php';
    }
}