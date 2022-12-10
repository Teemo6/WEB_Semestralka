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
        if(!isset($_GET["id"])){
            header("location: index.php?page=admin-clanky");
        }

        // Výběr dat
        $this->view->setData('clanek', $this->getArticle());

        // Výpis view
        ob_start();
        $this->view->getView($pageView);
        return ob_get_clean();
    }

    public function getArticle():array{
        return $this->model->getArticle();
    }
}

?>