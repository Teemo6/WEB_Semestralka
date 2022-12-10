<?php

class Controller{
    public function __construct($model){
        require_once(DIR_MODELS.$model.".php");
        $this->model = new $model;

        require_once(DIR_VIEWS . "View.php");
        $this->view = new View();
    }
}

?>