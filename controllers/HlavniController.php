<?php

require_once(DIR_CONTROLLERS."Controller.php");

class HlavniController extends Controller {
    public function __construct(){
        parent::__construct("HlavniModel");
    }

    /**
     * Ovládá logiku, zobrazuje stránku
     * @param $pageView defaultní stránka k zobrazení
     * @return string webová stránka
     */
    public function showPage($pageView):string{
        // Výběr dat
        $this->view->setData('clanky', $this->model->getAllArticles());

        // Výpis view
        ob_start();
        $this->view->getView($pageView);
        return ob_get_clean();
    }
}

?>