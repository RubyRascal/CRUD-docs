<?php

namespace Form\Item;

class AbstractItem
{
    protected $name;
    protected $value;
    protected $validationFunction;
    protected $template = '';

    public function __construct($name, $default = null, $label = null,  $validationFunction = null)
    {
        $this->name = $name;
        $this->validationFunction = $validationFunction;
    }

    public function isValid() {
        if (isset($_POST[$this->name])) {
            $this->value = $_POST[$this->name];
        }

        $f = $this->validationFunction;
        if ($f) {
            return $f($this->getValue());
        }
        return true;
    }

    public function getValue() {
//        Router::getInstance()->getVar($this->name);
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