<?php
namespace Validators;
class UserValidator
{
    public static function validateForm($result) {
        $errors = array();

        $formIsCorrect = true;

        if (empty($result["login"])) {
            $errors["loginErr"] = "Введите логин.";
            $formIsCorrect = false;
        } else {
            if (strlen($result["login"]) < 8) {
                $errors["loginErr"] = "Логин должен быть минимум 8 символов.";
                $formIsCorrect = false;
            }
        }

        if (empty($result["firstName"])) {
            $errors["firstNameErr"] = "Введите имя.";
            $formIsCorrect = false;
        } else {
            if (strlen($result["firstName"]) < 4) {
                $errors["firstNameErr"] = "Имя должно быть не менее 4 символов.";
                $formIsCorrect = false;
            }
        }

        if (empty($result["lastName"])) {
            $errors["lastNameErr"] = "Введите фамилию.";
            $formIsCorrect = false;
        } else {
            if (strlen($result["lastName"]) < 6) {
                $errors["lastNameErr"] = "Фамилия должна быть не менее 6 символов.";
                $formIsCorrect = false;
            }
        }

        if (empty($result["birthday"])) {
            $errors["birthdayErr"] = "Введите дату.";
            $formIsCorrect = false;
        }

        if ($result["active"] == null) {
            $result["active"] = "off";
        }

        $result["correct"] = $formIsCorrect;

        $Data = array(
            "result"=>$result,
            "errors"=>$errors
        );
        return $Data;
    }
}