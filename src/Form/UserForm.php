<?php

namespace Form;
use Models\userModel;
class UserForm extends Builder
{
    protected function  init(){
        $this->add("text","login","LOGIN",null,function($values)
        {
            if (empty($values)){
                return false;
            }
            return true;
        });
        $this->add("text","firstName","LOGIN",null,function($value)
        {
            if (empty($value)){
                return false;
            }
            return true;
        });
        $this->add("text","lastName","LOGIN",null,function($value)
        {
            if (empty($value)){
                return false;
            }
            return true;
        });
        $this->add("date","birthday","LOGIN",null,function($value)
        {
            if (empty($value)){
                return false;
            }
            return true;
        });
        $this->setModel(userModel::class);
        //var_dump($this);
    }
}