<?php

namespace Form;
use Models\userModel;
use Form\Item\AbstractItem;

class UserForm extends Builder
{
    protected function  init()
    {
        $notEmptyValidate = function($value, $name = null)
        {
            if (empty($value)){
                return $this->errors[] = [
                    $name => 'Field ' . $name . ' cannot be empty'
                ];
            }
            return true;
        };
        $notShorterThan = function($value, $name = null)
        {
            if (strlen($value) < 5){
                return [
                    $name => 'Field ' . $name . ' cannot shorter than 5'
                ];
            }
            return true;
        };
        $this->add(Builder::ITEM_TYPE_TEXT,"login",null, $notEmptyValidate);
        $this->add(Builder::ITEM_TYPE_TEXT,"firstName",null, $notEmptyValidate);
        $this->add(Builder::ITEM_TYPE_TEXT,"lastName",null,$notEmptyValidate);
        $this->add(Builder::ITEM_TYPE_DATE,"birthday",null,$notEmptyValidate);
        $this->setModel(userModel::class);
    }
    public function save($id = null)
    {
        $data = array();
        foreach ($this->elements as $item){
            $name = $item->getName();
            $value = $item->getValue();
            $data[$name] = $value;
        }
        if (isset($id) && $id != 0){
            $this->model->edit($id,$data);
        }else{
            $this->model->create($data);
        }
    }
}