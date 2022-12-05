<?php

abstract class AController {
    protected $db;

    public function __construct(){
        require_once(DIR_MODELS."DatabaseModel.php");
        $this->db = new DatabaseModel();
    }

    abstract public function fetchData():array;
}

?>