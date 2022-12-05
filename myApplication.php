<?php

class myApplication {
    private $temp;

    public function __construct(){
        require_once(DIR_CONTROLLERS."TemplateController.php");

        $this->temp = new TemplateController();
    }

    public function startApplication(){
        if(isset($_GET["page"]) && array_key_exists($_GET["page"], WEB_PAGES)){
            $pageKey = $_GET["page"];
        } else {
            $pageKey = DEFAULT_WEB_PAGE;
        }
        $pageInfo = WEB_PAGES[$pageKey];

        $this->temp->getView($pageInfo["file_name"]);
    }
}

?>

