<?php

class AdminController {
    public function __construct(){
        require_once(DIR_MODELS."AdminModel.php");
        $this->model = new AdminModel();

        require_once(DIR_VIEWS."View.php");
        $this->view = new View();
    }

    /**
     * Ovládá logiku, zobrazuje stránku
     * @param $pageView
     * @return string
     */
    public function showPage($pageView):string{
        // Obsluha odhlášení
        if(mySession::isSet("uroven") && mySession::get("uroven") >= 3){
            if(isset($_POST["update"])){
                $this->updateAuth();
            } else if(isset($_POST["delete"])){
            }
        }

        // Výběr dat
        $this->view->setData('uzivatel', $this->getAllUsers());
        $this->view->setData('opravneni', $this->getAllAuth());

        // Výpis view
        ob_start();
        $this->view->getView($pageView);
        return ob_get_clean();
    }

    public function getAllUsers():array{
        return $this->model->getAllUsers();
    }

    public function getAllAuth():array{
        return $this->model->getAllAuth();
    }

    public function updateAuth():int{
        return $this->model->updateAuth();
    }
}

?>