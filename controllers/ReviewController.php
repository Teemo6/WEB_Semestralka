<?php

require_once(DIR_CONTROLLERS."Controller.php");

class ReviewController extends Controller {
    public function __construct(){
        parent::__construct("ReviewModel");
    }

    /**
     * Ovládá logiku, zobrazuje stránku
     * @param $pageView defaultní stránka k zobrazení
     * @return string webová stránka
     */
    public function showPage($pageView):string{
        // Výběr dat
        $this->view->setData('clanky', $this->getAllArticles());

        // Výpis view
        ob_start();
        $this->view->getView($pageView);
        return ob_get_clean();
    }

    public function getAllArticles():array{
        return $this->model->getAllArticles();
    }
}

?>