<?php
require_once 'model/docModel.php';
require_once 'view/viewListDocs.php';
require_once 'view/viewDoc.php';
class DocController
{
    public function docs(){
        $view = new viewListDocs();
        $view->ViewListDocs();
    }

    public function create(){
        $DocsData = array(
            'organization' => $_POST["organization"],
            'agent' => $_POST["agent"],
            'podpisan' => $_POST["podpisan"],
            'date-start' => $_POST["date-start"],
            'date-finish' => $_POST["date-finish"],
            'item' => $_POST["item"],
            'money' => $_POST["money"],
            'ur-addres' => $_POST["ur-addres"],
            'fiz-addres' => $_POST["fiz-addres"],
            'INN' => $_POST["INN"],
            'payment' => $_POST["payment"]
        );

        $errors = array();

        if(isset($_POST["submitCreateDoc"])){

            $model = new DocModel();
            $result=$model->create($DocsData);
            $formIsCorrect = true;

            if (empty($result["organization"])) {
                $organizationErr = "Введите логин.";
                $formIsCorrect = false;
            } else {
                if (strlen($result["organization"]) < 8) {
                    $organizationErr = "Логин должен быть минимум 8 символов.";
                    $formIsCorrect = false;
                }
            }

            if (empty($result["agent"])) {
                $agentErr = "Введите имя.";
                $formIsCorrect = false;
            } else {
                if (strlen($result["agent"]) < 4) {
                    $agentErr = "Имя должно быть не менее 4 символов.";
                    $formIsCorrect = false;
                }
            }

            if (empty($result["podpisan"])) {
                $podpisanErr = "Введите имя.";
                $formIsCorrect = false;
            } else {
                if (strlen($result["podpisan"]) < 4) {
                    $podpisanErr = "Имя должно быть не менее 4 символов.";
                    $formIsCorrect = false;
                }
            }

            if (empty($result["date-start"])) {
                $dateStartErr = "Введите дату начала.";
                $formIsCorrect = false;
            }

            if (empty($result["date-finish"])) {
                $dateFinishErr = "Введите дату окончания.";
                $formIsCorrect = false;
            }

            if (empty($result["item"])) {
                $itemErr = "Введите предмет договора.";
                $formIsCorrect = false;
            }

            if (empty($result["money"])) {
                $moneyErr = "Введите сумму.";
                $formIsCorrect = false;
            } else {
                if (strlen($result["money"]) < 4) {
                    $moneyErr = "Сумма должна быть не менее 4 символов.";
                    $formIsCorrect = false;
                }
            }

            if (empty($result["ur-addres"])) {
                $urAddresErr = "Введите юридический адрес.";
                $formIsCorrect = false;
            } else {
                if (strlen($result["ur-addres"]) < 20) {
                    $urAddresErr = "Юридический адресс должен быть не менее 20 символов.";
                    $formIsCorrect = false;
                }
            }

            if (empty($result["fiz-addres"])) {
                $fizAddresErr = "Введите физический адрес.";
                $formIsCorrect = false;
            } else {
                if (strlen($result["fiz-addres"]) < 20) {
                    $fizAddresErr = "Физический адрес должен быть не менее 20 символов.";
                    $formIsCorrect = false;
                }
            }

            if (empty($result["INN"])) {
                $innErr = "Введите ИНН.";
                $formIsCorrect = false;
            } else {
                if (strlen($result["INN"]) != 10) {
                    $innErr = "Неверный ИНН.";
                    $formIsCorrect = false;
                }
            }

            if (empty($result["payment"])) {
                $paymentErr = "Введите расчетный счет.";
                $formIsCorrect = false;
            } else {
                if (strlen($result["payment"]) != 20) {
                    $paymentErr = "Неверный расчетный счет.";
                    $formIsCorrect = false;
                }
            }

            $errors = array(
                "organizationErr" => $organizationErr,
                "agentErr" => $agentErr,
                "podpisanErr" => $podpisanErr,
                "dateStartErr" => $dateStartErr,
                "dateFinishErr" => $dateFinishErr,
                "itemErr" => $itemErr,
                "moneyErr" => $moneyErr,
                "urAddresErr" => $urAddresErr,
                "fizAddresErr" => $fizAddresErr,
                "innErr" => $innErr,
                "paymentErr" => $paymentErr
            );
            $result["correct"] = $formIsCorrect;
        }
        if ($formIsCorrect){
            $model->save($result, $_GET["id"]);
        }else{
            $this->view($result, $errors);//возможно $this
        }
    }

    public function edit(){
        if (isset($_GET["id"])) {
            $dir = '/var/www/data/docs/';
            $fileDocs = $dir . $_GET["id"] . '.json';
            $readFile = file_get_contents($fileDocs);
            $DocArr = json_decode($readFile, true);
        }

        $DocsData = array(
            'organization' => $DocArr["organization"],
            'agent' => $DocArr["agent"],
            'podpisan' => $DocArr["podpisan"],
            'date-start' => $DocArr["date-start"],
            'date-finish' => $DocArr["date-finish"],
            'item' => $DocArr["item"],
            'money' => $DocArr["money"],
            'ur-addres' => $DocArr["ur-addres"],
            'fiz-addres' => $DocArr["fiz-addres"],
            'INN' => $DocArr["INN"],
            'payment' => $DocArr["payment"]
        );

        $errors = array();

        $model = new docModel();
        $result = $model->edit($_REQUEST);
        $formIsCorrect = true;

        if (empty($result["organization"])) {
            $organizationErr = "Введите организацию.";
            $formIsCorrect = false;
        } else {
            if (strlen($result["organization"]) < 8) {
                $organizationErr = "Организация должен быть минимум 8 символов.";
                $formIsCorrect = false;
            }
        }

        if (empty($result["agent"])) {
            $agentErr = "Введите имя контрагента.";
            $formIsCorrect = false;
        } else {
            if (strlen($result["agent"]) < 4) {
                $agentErr = "Имя контрагента должно быть не менее 4 символов.";
                $formIsCorrect = false;
            }
        }

        if (empty($result["podpisan"])) {
            $podpisanErr = "Введите имя.";
            $formIsCorrect = false;
        } else {
            if (strlen($result["podpisan"]) < 4) {
                $podpisanErr = "Имя должно быть не менее 4 символов.";
                $formIsCorrect = false;
            }
        }

        if (empty($result["date-start"])) {
            $dateStartErr = "Введите дату начала.";
            $formIsCorrect = false;
        }

        if (empty($result["date-finish"])) {
            $dateFinishErr = "Введите дату окончания.";
            $formIsCorrect = false;
        }

        if (empty($result["item"])) {
            $itemErr = "Введите предмет договора.";
            $formIsCorrect = false;
        }

        if (empty($result["money"])) {
            $moneyErr = "Введите сумму.";
            $formIsCorrect = false;
        } else {
            if (strlen($result["money"]) < 4) {
                $moneyErr = "Сумма должна быть не менее 4 символов.";
                $formIsCorrect = false;
            }
        }

        if (empty($result["ur-addres"])) {
            $urAddresErr = "Введите юридический адрес.";
            $formIsCorrect = false;
        } else {
            if (strlen($result["ur-addres"]) < 20) {
                $urAddresErr = "Юридический адресс должен быть не менее 20 символов.";
                $formIsCorrect = false;
            }
        }

        if (empty($result["fiz-addres"])) {
            $fizAddresErr = "Введите физический адрес.";
            $formIsCorrect = false;
        } else {
            if (strlen($result["fiz-addres"]) < 20) {
                $fizAddresErr = "Физический адрес должен быть не менее 20 символов.";
                $formIsCorrect = false;
            }
        }

        if (empty($result["INN"])) {
            $innErr = "Введите ИНН.";
            $formIsCorrect = false;
        } else {
            if (strlen($result["INN"]) != 10) {
                $innErr = "Неверный ИНН.";
                $formIsCorrect = false;
            }
        }

        if (empty($result["payment"])) {
            $paymentErr = "Введите расчетный счет.";
            $formIsCorrect = false;
        } else {
            if (strlen($result["payment"]) != 20) {
                $paymentErr = "Неверный расчетный счет.";
                $formIsCorrect = false;
            }
        }

        $errors = array(
            "organizationErr" => $organizationErr,
            "agentErr" => $agentErr,
            "podpisanErr" => $podpisanErr,
            "dateStartErr" => $dateStartErr,
            "dateFinishErr" => $dateFinishErr,
            "itemErr" => $itemErr,
            "moneyErr" => $moneyErr,
            "urAddresErr" => $urAddresErr,
            "fizAddresErr" => $fizAddresErr,
            "innErr" => $innErr,
            "paymentErr" => $paymentErr
        );
        $result["correct"] = $formIsCorrect;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $result["correct"]) {
            $updateDoc = json_encode($_REQUEST, true);
            $model->save($result, $_GET["id"]);
        }elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $result["correct"] == false) {
            $this->view($_REQUEST, $errors);
        }else{
            $this->view($DocsData, $errors);
        }
    }

    public function view($result, $errors)
    {
        $view = new viewDoc();
        $view->ViewFormDoc($result, $errors);
    }

    public function delete(){
        $model = new docModel();
        $model->delete();
    }
}