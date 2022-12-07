<?php

class View{
    protected $dataFetch;
    protected $queryResult;

    public function getView($page){
        global $dataFetch;
        global $queryResult;

        $dataFetch = $this->dataFetch;
        $queryResult = $this->queryResult;

        require(DIR_VIEWS."header.php");
        require(DIR_VIEWS.$page.".php");
        require(DIR_VIEWS."footer.php");
    }

    public function setData($data){
        $this->dataFetch = $data;
    }

    public function setResult($res){
        $this->queryResult = $res;
    }

    public function getResult():int{
        return $this->queryResult;
    }
}

?>