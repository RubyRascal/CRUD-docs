<?php

namespace Models;

use Models\DbAdapter;

class DbModel
{
    public $table;
    public function list()
    {
        $query = "SELECT * FROM $this->table";
        $db = DBAdapter::getInstance();
        $result = $db->execSQL($query);
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
        return $users;
    }

    public function create($data)
    {
    var_dump($data);
    die();
        unset($data["correct"]);
        $columns_part = '';
        $values_part = '';

        foreach ($data as $column => $value) {
            if (!empty($columns_part)) {
                $columns_part .= ", ";
            }

            $columns_part .= "{$column}";

            if (!empty($values_part)) {
                $values_part .= ", ";
            }
            $values_part .= "'{$value}'";
        }

        $columns_part = "(" . $columns_part  . ")";
        $values_part = "(" . $values_part  . ")";

        $query = "INSERT INTO $this->table $columns_part VALUES $values_part";
        var_dump($query);
        die();
        $db = DbAdapter::getInstance();
        $conn = $db->getConnect();
        $result = $db->execSQL($query);
        return $data;
    }

    public function edit($idFromTable, $data)
    {
        unset($data["submitEdit"]);
        $idFromTable = (int)$idFromTable;
        foreach ($data as $key=>$val)
        {
            $queryValue .= " $key='$val',";
        }
        $queryValue[strlen($queryValue)-1] = ' ';

        $query = "UPDATE $this->table SET {$queryValue} WHERE user_id={$idFromTable}";

        //$query .= "WHERE user_id={$idFromTable}";


//        $query = "UPDATE myapp.users SET ";
//        foreach ($data as $key=>$val)
//        {
//            $query .= "$key='$val', ";
//        }
//        $query .= "WHERE user_id={$idFromTable}";

        $db = DBAdapter::getInstance();
        $conn = $db->getConnect();
        $result = $db->execSQL($query);
        $editData = array(
            'login' => $data['login'],
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'birthday' => $data['birthday'],
            'active' => $data['active']
        );
        return $editData;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE user_id = {$id}";
        $db = DbAdapter::getInstance();
        $conn = $db->getConnect();
        $result = $db->execSQL($sql);
    }
}