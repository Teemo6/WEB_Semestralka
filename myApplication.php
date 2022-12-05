<?php

class myApplication {
    private $view;

    public function __construct(){
        require_once(DIR_VIEWS."View.php");

        $this->view = new View();
    }

    public function startApplication(){
        if(isset($_GET["page"]) && array_key_exists($_GET["page"], WEB_PAGES)){
            $pageKey = $_GET["page"];
        } else {
            $pageKey = DEFAULT_WEB_PAGE;
        }
        $pageInfo = WEB_PAGES[$pageKey];

        // tady
        require_once(DIR_CONTROLLERS.$pageInfo["controller"].".php");

        $pageController = new $pageInfo["controller"];
        $data = $pageController->fetchData();

        $this->view->getView($pageInfo["view"], $data);
    }
}

?>

