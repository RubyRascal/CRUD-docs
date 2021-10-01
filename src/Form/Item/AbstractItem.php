<?php

namespace Form\Item;

class AbstractItem
{
    protected $name;
    protected $value;
    protected $validationFunction;
    protected $errors = [];
    protected $template = '';

    public function __construct($name, $default = null,  $validationFunction = null)
    {
        $this->name = $name;
        $this->validationFunction = $validationFunction;
    }

    public function isValid() {
        if (isset($_POST[$this->name])) {
            $this->value = $_POST[$this->name];
            if ($this->value == ''){
                $this->errors[$this->name] = 'Field ' . $this->name . ' is null';
            }
        }
//        if (empty($this->value)){
//            $this->errors = $this->validationFunction;
//            return $this->errors;
//        }
        $f = $this->validationFunction;
        if ($f) {
            return $f($this->getValue(), $this->getName());
        }
        return true;
    }

    public function getValue() {
        return $this->value;
    }

    public function setValue($value) {
        $this->value = $value;
    }

    public function getName() {
        return $this->name;
    }

    public function render() {
        require("Views/form/" . $this->template . ".php");
    }
}