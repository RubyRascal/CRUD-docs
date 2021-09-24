<?php
class userModel
{
    public function save($result, $id)
    {
        $id = (int)$id;
        $dir = '/var/www/data/users/';
        if ($id == null){
            $id = 1;
            $fileUsers = $dir . $id . '.json';
        }

        while (is_file($fileUsers)) {
            $fileUsers = $dir . ++$id . '.json';
        }

        if ($id >= 1){
            $fileUsers = $dir . $id . '.json';
        }

        if ($result["correct"]) {
            $json_string = json_encode($result);
            file_put_contents($fileUsers, $json_string);
            header('Location: /users');
        }
    }

    public function edit($userDataToEdit)
    {
        return $userDataToEdit;
    }

    public function create($userDataToCreate)
    {
        return $userDataToCreate;
    }

    public function delete()
    {
        $dir = '/var/www/data/users/';
        $file = $dir . $_GET["id"] . '.json';
        unlink($file);
        header('Location: /users');
    }
}