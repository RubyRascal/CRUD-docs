<?php

class docModel
{
    public function save($result, $id)
    {
        $id = (int)$id;
        $dir = '/var/www/data/docs/';
        if ($id == null){
            $id = 1;
            $fileDocs = $dir . $id . '.json';
        }

        while (is_file($fileDocs)) {
            $fileDocs = $dir . ++$id . '.json';
        }

        if ($id >= 1){
            $fileDocs = $dir . $id . '.json';
        }

        if ($result["correct"]) {
            $json_string = json_encode($result);
            file_put_contents($fileDocs, $json_string);
            header('Location: /docs');
        }
    }

    public function edit($DocDataToEdit)
    {
        return $DocDataToEdit;
    }

    public function create($DocDataToCreate)
    {
        return $DocDataToCreate;
    }

    public function delete()
    {
        $dir = '/var/www/data/docs/';
        $file = $dir . $_GET["id"] . '.json';
        unlink($file);
        header('Location: /docs');
    }
}