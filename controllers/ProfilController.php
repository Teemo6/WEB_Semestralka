<?php

require_once("mySession.php");

class ProfilController {
    public function __construct(){
        require_once(DIR_MODELS."ProfilModel.php");
        $this->model = new ProfilModel();

        require_once(DIR_VIEWS."View.php");
        $this->view = new View();
    }

    public function showPage($pageView):string{
        ob_start();
        $this->view->getView($pageView);
        return ob_get_clean();
    }

}

?>