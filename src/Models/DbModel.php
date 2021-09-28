<?php
namespace Models;
use Models\DbAdapter;
use PDO;
class DbModel
{
    public $connect;
    public $list;
    public $id;
    public $insert;
    public function getById()
    {
        $sth = $this->id->prepare("SELECT user_id FROM myapp.users");
        $sth->execute();
        return $this->id;
    }

    public function list()
    {
        $users = array();
        $this->connect = new DbAdapter();
        $this->list = $this->connect->getConnect();
        $sth = $this->list->prepare("SELECT * FROM myapp.users");
        $sth->execute();

        while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
            $users[] = $row;
        }
        return $users;
    }

    public function save($result, $id = null)
    {
        $userId = $this->getById();

//        $id = (int)$id;
//        if ($id == null){
//            $id = 1;
//            $file = $this->dir . $id . '.json';
//        }
//
//        while (is_file($file)) {
//            $file = $this->dir . ++$id . '.json';
//        }
//
//        if ($id >= 1){
//            $file = $this->dir . $id . '.json';
//        }
//
//        if ($result["result"]["correct"]) {
//            $json_string = json_encode($result["result"]);
//            file_put_contents($file, $json_string);
//            chmod($file, 0777);
//        }
    }

    public function create($data)
    {
        $this->connect = new DbAdapter();
        $this->insert = $this->connect->getConnect();
        $this->insert->query("INSERT INTO myapp.users (login, firstName, lastName, birthday, active)
                        VALUES (".$data['login'].", ".$data['firstName'].", ".$data['lastName'].", ".$data['birthday'].", ".$data['active'].")");
        return $data;
    }

    public function edit($id, $data)
    {

    }

    public function delete($id)
    {

    }
}