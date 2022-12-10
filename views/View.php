<?php

class View{
    protected $dataFetch;
    protected $queryResult;

    /**
     * Sestaví stránku pro zobrazení
     */
    public function getView($page){
        global $dataFetch;
        global $queryResult;

        $dataFetch = $this->dataFetch;
        $queryResult = $this->queryResult;

        require(DIR_VIEWS."header.php");
        require(DIR_VIEWS.$page.".php");
        require(DIR_VIEWS."footer.php");
    }

    /**
     * Nastaví atribut data podle klíče
     */
    public function setData($key, $data){
        $this->dataFetch[$key] = $data;
    }

    /**
     * Vrátí atribut data podle klíče
     */
    public function getData($key):array{
        return $this->dataFetch[$key];
    }

    /**
     * Nastaví atribut result
     */
    public function setResult($res){
        $this->queryResult = $res;
    }

    /**
     * Vrátí atribut result
     */
    public function getResult():int{
        return $this->queryResult;
    }
}

?>