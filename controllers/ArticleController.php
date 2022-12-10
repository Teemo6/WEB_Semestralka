<?php

class ArticleController {
    public function __construct(){
        require_once(DIR_MODELS."ArticleModel.php");
        $this->model = new ArticleModel();

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
        $this->view->setData('clanky', $this->getAllArticles());
        $this->view->setData('recenzenti', $this->getAllArticles());

        // Výpis view
        ob_start();
        $this->view->getView($pageView);
        return ob_get_clean();
    }

    public function getAllArticles():array{
        return $this->model->getAllArticles();
    }

    public function getAllReviewers():array{
        return $this->model->getAllReviewers();
    }
}

?>