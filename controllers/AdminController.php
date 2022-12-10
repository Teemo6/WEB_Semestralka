<?php

require_once(DIR_CONTROLLERS."Controller.php");

class AdminController extends Controller{
    public function __construct(){
        parent::__construct("AdminModel");
    }

    /**
     * Ovládá logiku, zobrazuje stránku
     * @param $pageView defaultní stránka k zobrazení
     * @return string webová stránka
     */
    public function showPage($pageView):string{
        // Obsluha ovládání
        if(mySession::isSet("uroven") && mySession::get("uroven") >= 3){
            if(isset($_POST["update"])){
                $this->view->setResult($this->model->updateAuth());
            } else if(isset($_POST["delete"])){
                $this->view->setResult($this->model->deleteUser());
            }
        }

        // Výběr dat
        $this->view->setData('uzivatel', $this->model->getAllUsers());
        $this->view->setData('opravneni', $this->model->getAllAuth());

        // Výpis view
        ob_start();
        $this->view->getView($pageView);
        return ob_get_clean();
    }
}

?>