<?php

require_once(DIR_CONTROLLERS."Controller.php");

class AboutController extends Controller {
    public function __construct(){
        parent::__construct("DatabaseModel");
    }

    /**
     * Ovládá logiku, zobrazuje stránku
     * @param $pageView defaultní stránka k zobrazení
     * @return string webová stránka
     */
    public function showPage($pageView):string{
        // Výpis view
        ob_start();
        $this->view->getView($pageView);
        return ob_get_clean();
    }
}

?>