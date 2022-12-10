<?php

class HlavniController {
    public function __construct(){
        require_once(DIR_MODELS."HlavniModel.php");
        $this->model = new HlavniModel();

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