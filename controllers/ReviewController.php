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

        if(isset($_POST["recSubmit"])){
            $this->view->setResult($this->model->setReviewer());
        }

        if(isset($_POST["recDelete"])){
            $this->view->setResult($this->model->deleteReview());
        }

        if(isset($_POST["artConfirm"])){
            $this->view->setResultKey('rozhodnuti' ,$this->model->confirmArticle());
        }

        if(isset($_POST["artRevoke"])){
            $this->view->setResult($this->model->revokeArticle());
        }

        if(isset($_POST["artDelete"])){
            $this->view->setResult($this->model->deleteArticle());
            header("location: index.php?page=admin-clanky");
        }

        // Výběr dat
        $this->view->setData('clanek', $this->model->getArticle());
        $this->view->setData('recenzenti_vsichni', $this->model->getReviewers());
        $this->view->setData('recenze', $this->model->getReviews());

        // Výpis view
        ob_start();
        $this->view->getView($pageView);
        return ob_get_clean();
    }
}

?>