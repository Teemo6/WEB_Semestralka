<?php

class TemplateController{
    public function getView($page){
        require(DIR_VIEWS."header.php");
        require(DIR_VIEWS.$page.".php");
        require(DIR_VIEWS."footer.php");
    }
}