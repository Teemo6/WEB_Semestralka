<?php

require_once(DIR_CONTROLLERS."Controller.php");

class RecenzentController extends Controller {
    public function __construct(){
        parent::__construct("RecenzentModel");
    }

    /**
     * Ovládá logiku, zobrazuje stránku
     * @param $pageView defaultní stránka k zobrazení
     * @return string webová stránka
     */
    public function showPage($pageView):string{
        if (isset($_POST['rate'])) {
            $this->view->setResult($this->model->rateArticle());
        }

        $this->view->setData('clanky', $this->model->getArticles());
        $this->view->setData('recenze', $this->model->getArticles());

        // Výpis view
        ob_start();
        $this->view->getView($pageView);
        return ob_get_clean();
    }
}

?>