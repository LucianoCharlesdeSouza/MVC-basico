<?php

class Controller 
{

    public function __construct() 
    {
    }

    public function __call($name, $arguments) 
    {
        $this->loadTemplate('error_404');
    }

    public function loadView($viewName, $viewData = array()) 
    {
        extract($viewData);
        include 'views/' . $viewName . '.php';
    }

    public function loadTemplate($viewName, $viewData = array()) 
    {

        include 'views/template.php';
    }

    public function loadViewInTemplate($viewName, $viewData) 
    {
        extract($viewData);
        include 'views/' . $viewName . '.php';
    }
    
        public function post($field, $type = FILTER_DEFAULT)
    {

        if (filter_input(INPUT_POST, $field) != null) {

            if ($type == 'int') {
                return $this->sanitize(filter_input(INPUT_POST, $field, FILTER_VALIDATE_INT))[0];
            }

            if ($type == 'email') {
                return $this->sanitize(filter_input(INPUT_POST, $field, FILTER_VALIDATE_EMAIL))[0];
            }

            if ($type == 'float') {
                return $this->sanitize(filter_input(INPUT_POST, $field, FILTER_VALIDATE_FLOAT))[0];
            }

            if ($type == 'bool') {
                return $this->sanitize(filter_input(INPUT_POST, $field, FILTER_VALIDATE_BOOLEAN))[0];
            }

            if ($type == 'url') {
                return $this->sanitize(filter_input(INPUT_POST, $field, FILTER_VALIDATE_URL))[0];
            }

            return $this->sanitize(filter_input(INPUT_POST, $field, $type))[0];
        }
        return "Campo <strong>{$field}</strong> inexistente!";
    }

    public function get($field, $type = FILTER_DEFAULT)
    {

        if (filter_input(INPUT_GET, $field) != null) {

            if ($type == 'int') {
                return $this->sanitize(filter_input(INPUT_GET, $field, FILTER_VALIDATE_INT))[0];
            }

            if ($type == 'email') {
                return $this->sanitize(filter_input(INPUT_GET, $field, FILTER_VALIDATE_EMAIL))[0];
            }

            if ($type == 'float') {
                return $this->sanitize(filter_input(INPUT_GET, $field, FILTER_VALIDATE_FLOAT))[0];
            }

            if ($type == 'bool') {
                return $this->sanitize(filter_input(INPUT_GET, $field, FILTER_VALIDATE_BOOLEAN))[0];
            }

            if ($type == 'url') {
                return $this->sanitize(filter_input(INPUT_GET, $field, FILTER_VALIDATE_URL))[0];
            }

            return $this->sanitize(filter_input(INPUT_GET, $field, $type))[0];
        }
        return "Campo <strong>{$field}</strong> inexistente!";
    }

    public function is_empty($field)
    {
        return (empty($field)) ? true : false;
    }

    public function sanitize($field)
    {
        $data = array_map('strip_tags', [$field]);
        $data = array_map('trim', [$data][0]);
        return $data;
    }

}
