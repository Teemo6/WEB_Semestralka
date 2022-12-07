<?php

require_once("mySession.php");

class myApplication {

    public function startApplication(){
        mySession::start();

        if(isset($_GET["page"]) && array_key_exists($_GET["page"], WEB_PAGES)){
            $pageKey = $_GET["page"];
        } else {
            $pageKey = DEFAULT_WEB_PAGE;
        }
        $pageInfo = WEB_PAGES[$pageKey];

        require_once(DIR_CONTROLLERS.$pageInfo["controller"].".php");
        $pageController = new $pageInfo["controller"];

        echo $pageController->showPage($pageInfo["view"]);
    }
}

?>

