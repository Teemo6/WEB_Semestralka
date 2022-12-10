<?php

require_once(DIR_CONTROLLERS."Controller.php");

class AutorController extends Controller {
    public function __construct(){
        parent::__construct("AutorModel");
    }

    /**
     * Ovládá logiku, zobrazuje stránku
     * @param $pageView defaultní stránka k zobrazení
     * @return string webová stránka
     */
    public function showPage($pageView):string{
        // Obsluha nového článku
        if(isset($_POST["cSubmit"])){
            $this->view->setResult($this->newArticle());
        }

        // Výběr dat
        $this->view->setData('clanky', $this->getMyArticles());

        // Výpis view
        ob_start();
        $this->view->getView($pageView);
        return ob_get_clean();
    }

    public function getMyArticles():array{
        return $this->model->getMyArticles();
    }

    public function newArticle():int{
        return $this->model->newArticle();
    }
}

?>