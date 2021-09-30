<?php
namespace Validators;
class DocValidator
{
    public static function validateForm($result)
    {
        $errors = array();

        $formIsCorrect = true;

        if (empty($result["organization"])) {
            $errors["organizationErr"] = "Введите организацию.";
            $formIsCorrect = false;
        } else {
            if (strlen($result["organization"]) < 8) {
                $errors["organizationErr"] = "Организация должен быть минимум 8 символов.";
                $formIsCorrect = false;
            }
        }

        if (empty($result["agent"])) {
            $errors["agentErr"] = "Введите имя контрагента.";
            $formIsCorrect = false;
        } else {
            if (strlen($result["agent"]) < 4) {
                $errors["agentErr"] = "Имя контрагента должно быть не менее 4 символов.";
                $formIsCorrect = false;
            }
        }

        if (empty($result["podpisan"])) {
            $errors["podpisanErr"] = "Введите имя.";
            $formIsCorrect = false;
        } else {
            if (strlen($result["podpisan"]) < 4) {
                $errors["podpisanErr"] = "Имя должно быть не менее 4 символов.";
                $formIsCorrect = false;
            }
        }

        if (empty($result["dateStart"])) {
            $errors["dateStartErr"] = "Введите дату начала.";
            $formIsCorrect = false;
        }

        if (empty($result["dateFinish"])) {
            $errors["dateFinishErr"] = "Введите дату окончания.";
            $formIsCorrect = false;
        }

        if (empty($result["item"])) {
            $errors["itemErr"] = "Введите предмет договора.";
            $formIsCorrect = false;
        }

        if (empty($result["money"])) {
            $errors["moneyErr"] = "Введите сумму.";
            $formIsCorrect = false;
        } else {
            if (strlen($result["money"]) < 4) {
                $errors["moneyErr"] = "Сумма должна быть не менее 4 символов.";
                $formIsCorrect = false;
            }
        }

        if (empty($result["urAddress"])) {
            $errors["urAddresErr"] = "Введите юридический адрес.";
            $formIsCorrect = false;
        } else {
            if (strlen($result["urAddress"]) < 20) {
                $errors["urAddresErr"] = "Юридический адресс должен быть не менее 20 символов.";
                $formIsCorrect = false;
            }
        }

        if (empty($result["fizAddress"])) {
            $errors["fizAddresErr"] = "Введите физический адрес.";
            $formIsCorrect = false;
        } else {
            if (strlen($result["fizAddress"]) < 20) {
                $errors["fizAddresErr"] = "Физический адрес должен быть не менее 20 символов.";
                $formIsCorrect = false;
            }
        }

        if (empty($result["INN"])) {
            $errors["innErr"] = "Введите ИНН.";
            $formIsCorrect = false;
        } else {
            if (strlen($result["INN"]) != 10) {
                $errors["innErr"] = "Неверный ИНН.";
                $formIsCorrect = false;
            }
        }

        if (empty($result["payment"])) {
            $errors["paymentErr"] = "Введите расчетный счет.";
            $formIsCorrect = false;
        } else {
            if (strlen($result["payment"]) != 20) {
                $errors["paymentErr"] = "Неверный расчетный счет.";
                $formIsCorrect = false;
            }
        }

        $result["correct"] = $formIsCorrect;

        $Data = array(
            "result"=>$result,
            "errors"=>$errors
        );
        return $Data;
    }
}