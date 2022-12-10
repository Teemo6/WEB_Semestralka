<?php

class AutorController {
    public function __construct(){
        require_once(DIR_MODELS."AutorModel.php");
        $this->model = new AutorModel();

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
        $this->view->setData('clanky', $this->getMyArticles());

        // Obsluha registrace
        if(isset($_POST["cSubmit"])){
            $this->view->setResult($this->newArticle());
        }

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