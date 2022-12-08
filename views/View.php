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

    public function setData($key, $data){
        $this->dataFetch[$key] = $data;
    }

    public function getData($key):array{
        return $this->dataFetch[$key];
    }


    public function setResult($res){
        $this->queryResult = $res;
    }

    public function getResult():int{
        return $this->queryResult;
    }
}

?>