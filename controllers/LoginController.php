<?php

require_once(DIR_CONTROLLERS."Controller.php");

class LoginController extends Controller {
    public function __construct(){
        parent::__construct("LoginModel");
    }

    /**
     * Ovládá logiku, zobrazuje stránku
     * @param $pageView defaultní stránka k zobrazení
     * @return string webová stránka
     */
    public function showPage($pageView):string{
        // Obsluha odhlášení
        if(mySession::isSet("id")){
            if(isset($_POST["oSubmit"])){
                $this->model->logout();
            }
            header("location: index.php?page=clanky");
        }

        // Obsluha registrace
        if(isset($_POST["rSubmit"])){
            $this->view->setResult($this->model->register());
        }

        // Obsluha přihlášení
        if(isset($_POST["lSubmit"])){
            $this->view->setResult($this->model->login());
            if($this->view->getResult() == 0){
                header("location: index.php?page=clanky");
            }
        }

        // Výpis view
        ob_start();
        $this->view->getView($pageView);
        return ob_get_clean();
    }
}

?>