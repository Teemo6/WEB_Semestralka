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
     * @param $pageView defaultní stránka k zobrazení
     * @return string webová stránka
     */
    public function showPage($pageView):string{
        // Výběr dat
        $this->view->setData('uzivatel', $this->getAllUsers());
        $this->view->setData('opravneni', $this->getAllAuth());

        // Obsluha ovládání
        if(mySession::isSet("uroven") && mySession::get("uroven") >= 3){
            if(isset($_POST["update"])){
                $this->view->setResult($this->updateAuth());
            } else if(isset($_POST["delete"])){
                $this->view->setResult($this->deleteUser());
            }
        }

        // Výpis view
        ob_start();
        $this->view->getView($pageView);
        return ob_get_clean();
    }

    /**
     * Vrátí data všech uživatelů
     */
    public function getAllUsers():array{
        return $this->model->getAllUsers();
    }

    /**
     * Vrátí data všech rolí
     */
    public function getAllAuth():array{
        return $this->model->getAllAuth();
    }

    /**
     * Vyhodnotí úpravu uživatele
     * @return int hláška úpravy uživatele
     */
    public function updateAuth():int{
        return $this->model->updateAuth();
    }

    /**
     * Vyhodnotí smazání uživatele
     * @return int hláška smazání uživatele
     */
    public function deleteUser():int{
        return $this->model->deleteUser();
    }
}

?>