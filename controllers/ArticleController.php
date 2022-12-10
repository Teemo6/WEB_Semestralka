<?php

require_once(DIR_CONTROLLERS."Controller.php");

class ArticleController extends Controller {
    public function __construct(){
        parent::__construct("ArticleModel");
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