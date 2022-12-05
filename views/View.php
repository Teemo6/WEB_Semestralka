<?php

class View{
    public function getView($page, $data){
        global $dataFetch;
        $dataFetch = $data;

        require(DIR_VIEWS."header.php");
        require(DIR_VIEWS.$page.".php");
        require(DIR_VIEWS."footer.php");
    }
}

?>