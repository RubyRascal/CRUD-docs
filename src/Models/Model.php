<?php
namespace Models;
class Model
{
    public $dir = '';

    public function save($result, $id = null)
    {
        $id = (int)$id;
        if ($id == null){
            $id = 1;
            $file = $this->dir . $id . '.json';
        }

        while (is_file($file)) {
            $file = $this->dir . ++$id . '.json';
        }

        if ($id >= 1){
            $file = $this->dir . $id . '.json';
        }

        if ($result["result"]["correct"]) {
            $json_string = json_encode($result["result"]);
            file_put_contents($file, $json_string);
            chmod($file, 0777);
        }
    }

    public function edit()
    {
        $file = $this->dir . $_GET["id"] . '.json';
        $readFile = file_get_contents($file);
        $DataArr = json_decode($readFile, true);

        $Data = array(
            "ToEdit" => $_REQUEST,
            "FromFile" => $DataArr
        );
        return $Data;
    }

    public function create($DataToCreate)
    {
        return $DataToCreate;
    }

    public function delete()
    {
        $file = $this->dir . $_GET["id"] . '.json';
        unlink($file);
    }

    public function list()
    {

        $files = array_diff(scandir($this->dir), ['..', '.']);
        $result = array();

        foreach ($files as $file) {
            $string = file_get_contents($this->dir . '/' . $file);
            $outmsv = json_decode($string, true);
            $id = $this->createId($file);
            $result[] = array(
                "id" => $id,
                "json" => $outmsv
            );
        }
        return $result;
    }

    protected function createId($file)
    {
        $len = strlen($file);
        $fileName = substr($file, 0, $len - 5);
        return $fileName;
    }
}