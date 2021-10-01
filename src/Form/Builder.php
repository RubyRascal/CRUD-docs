<?php

namespace Form;
use Form\Item\Text;
use Form\Item\Date;
use Form\Item\Submit;
class Builder
{
    const ITEM_TYPE_TEXT = "text";
    const ITEM_TYPE_DATE = "date";
    protected $errors = [];
    public $model;

    public function __construct()
    {
        $this->init();
    }


    protected function init()
    {
        // INITIALIZATION
    }

    protected $elements = [];

    public function add($type, $name, $default = null, $validationFunction)
    {
        if ($type == self::ITEM_TYPE_TEXT) {
            $this->elements[] = new Text($name, $default, $validationFunction);
        } elseif ($type == 'date') {
            $this->elements[] = new Date($name, $default, $validationFunction);
        } elseif ($type == 'submit') {
            $this->elements[] = new Submit($name, $default, $validationFunction);
        }
    }

    public function setModel($modelClass)
    {
        $this->model = new $modelClass();
    }

    public function load($id) {
        if ($id > 0) {
            $data = $this->model->getById($id);

            foreach ($this->elements as $element) {
                $elementName = $element->getName();
                if (isset($data[$elementName])) {
                    $element->setValue($data[$elementName]);
                }
            }
        }
    }

    public function isSubmitted()
    {
        return !!count($_POST);
    }

    public function isValid() {
        $valid = true;
        foreach ($this->elements as $element) {
            if (!$element->isValid())
            {
                $valid = false;
            }
        }
        return $valid;
    }

    public function render()
    {
        ob_start();
        foreach ($this->elements as $element) {
            $element->render();
        }
        $elements = ob_get_clean();
        require("Views/form/form.php");
    }
}