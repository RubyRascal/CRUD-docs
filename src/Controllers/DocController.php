<?php
namespace Controllers;
use Models\DbAdapter;
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
            'dateStart' => $_POST["dateStart"],
            'dateFinish' => $_POST["dateFinish"],
            'item' => $_POST["item"],
            'money' => $_POST["money"],
            'urAddress' => $_POST["urAddress"],
            'fizAddress' => $_POST["fizAddress"],
            'INN' => $_POST["INN"],
            'payment' => $_POST["payment"]
        );

        if(isset($_POST["submitCreate"])) {
            $model = new \Models\docModel();
            $validate = DocValidator::validateForm($DocsData);
            $model->create($validate["result"]);
        }

        if ($validate["result"]["correct"]){
            header('Location: /docs');
        }else{
            var_dump($validate["errors"]);
            $this->view($validate["result"], $validate["errors"]);
        }
    }

    public function edit()
    {
        $model = new \Models\docModel();
        $query = "SELECT * FROM myapp.docs WHERE user_id ={$_GET["id"]}";
        $db = DbAdapter::getInstance();
        $conn = $db->getConnect();
        $resultExec = $db->execSQL($query);

        while ($row = mysqli_fetch_assoc($resultExec)){
            $data = $row;
        }
        if (count($_POST)==0){
            $DocsData = array(
                'organization' => $data["organization"],
                'agent' => $data["agent"],
                'podpisan' => $data["podpisan"],
                'dateStart' => $data["dateStart"],
                'dateFinish' => $data["dateFinish"],
                'item' => $data["item"],
                'money' => $data["money"],
                'urAddress' => $data["urAddress"],
                'fizAddress' => $data["fizAddress"],
                'INN' => $data["INN"],
                'payment' => $data["payment"]
            );
            $this->view($DocsData, $validate["errors"]);
        }
        $result = $model->edit($_GET["id"], $_POST);
        $validate = DocValidator::validateForm($result);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $validate["result"]["correct"]) {
            header('Location: /docs');
        }elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $validate["result"]["correct"] == false) {
            $this->view($validate["result"], $validate["errors"]);
        }
    }

    public function view($result, $errors)
    {
        $view = new \Views\viewDoc();
        $view->ViewFormDoc($result, $errors);
    }

    public function delete(){
        $model = new \Models\docModel();
        $model->delete($_GET["id"]);
        header('Location: /docs');
    }
}