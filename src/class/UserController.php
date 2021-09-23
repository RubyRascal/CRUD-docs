<?php
require_once 'Controller.php';
require 'model/userModel.php';
require 'view/viewUser.php';
require 'view/viewListUser.php';
class UserController extends Controller
{
    public function users()
    {
        $model = new viewListUser();
        $model->ViewListUser();
    }
    public function create()
    {
        $model = new userModel();
        $model->create();
        $this->view();
    }

    public function edit()
    {
        $model = new userModel();
        $model->edit();
        $this->view();
    }

    public function view()
    {
        $view = new viewUser();
        $view->ViewFormUser();
    }
}