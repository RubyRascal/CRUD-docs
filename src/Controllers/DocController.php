<?php
namespace Controllers;
use Models\docModel;
use Views\viewListDocs;
use Views\viewDoc;
use Validators\DocValidator;
class DocController
{
    public function docs()
    {
        $model = new \Models\docModel();
        $view = new \Views\viewListDocs();
        $view->ViewList($model->list());
    }

    public function create()
    {
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

        if(isset($_POST["submitCreateDoc"])) {
            $model = new \Models\docModel();
            $result = $model->create($DocsData);
            $validate = DocValidator::validateForm($result);
        }

        if ($validate["result"]["correct"]){
            $model->save($validate);
            header('Location: /docs');
        }else{
            $this->view($validate["result"], $validate["errors"]);
        }
    }

    public function edit()
    {
        $model = new \Models\docModel();
        $result = $model->edit();
        $DocsData = array(
            'organization' => $result["FromFile"]["organization"],
            'agent' => $result["FromFile"]["agent"],
            'podpisan' => $result["FromFile"]["podpisan"],
            'date-start' => $result["FromFile"]["date-start"],
            'date-finish' => $result["FromFile"]["date-finish"],
            'item' => $result["FromFile"]["item"],
            'money' => $result["FromFile"]["money"],
            'ur-addres' => $result["FromFile"]["ur-addres"],
            'fiz-addres' => $result["FromFile"]["fiz-addres"],
            'INN' => $result["FromFile"]["INN"],
            'payment' => $result["FromFile"]["payment"]
        );

        $validate = DocValidator::validateForm($result["ToEdit"]);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $validate["result"]["correct"]) {
            $updateDoc = json_encode($result["ToEdit"], true);
            $model->save($validate, $_GET["id"]);
            header('Location: /docs');
        }elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $validate["result"]["correct"] == false) {
            $this->view($result["ToEdit"], $validate["errors"]);
        }else{
            $this->view($DocsData, $validate["errors"]);
        }
    }

    public function view($result, $errors)
    {
        $view = new \Views\viewDoc();
        $view->ViewFormDoc($result, $errors);
    }

    public function delete(){
        $model = new \Models\docModel();
        $model->delete();
        header('Location: /docs');
    }
}