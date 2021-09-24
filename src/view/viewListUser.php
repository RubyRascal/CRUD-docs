<?php
require_once 'func_users.php';
class viewListUser
{
    public function viewList()
    {
        $UserArr = getUsersArray();
        require_once 'listUsers.php';
    }
}