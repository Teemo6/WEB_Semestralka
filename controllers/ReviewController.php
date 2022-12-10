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
            $this->view->setResult($this->setReviewer());
        }

        if(isset($_POST["recDelete"])){
            $this->view->setResult($this->deleteReview());
        }

        if(isset($_POST["artConfirm"])){
            $this->view->setResult($this->confirmArticle());
        }

        if(isset($_POST["artRevoke"])){
            $this->view->setResult($this->revokeArticle());
        }

        if(isset($_POST["artDelete"])){
            $this->view->setResult($this->deleteArticle());
            header("location: index.php?page=admin-clanky");
        }

        // Výběr dat
        $this->view->setData('clanek', $this->getArticle());
        $this->view->setData('recenzenti_vsichni', $this->getReviewers());
        $this->view->setData('recenze', $this->getReviews());

        // Výpis view
        ob_start();
        $this->view->getView($pageView);
        return ob_get_clean();
    }

    public function getArticle():array{
        return $this->model->getArticle();
    }

    public function getReviewers():array{
        return $this->model->getReviewers();
    }

    public function getReviews():array{
        return $this->model->getReviews();
    }

    public function setReviewer():int{
        return $this->model->setReviewer();
    }

    public function deleteReview():int{
        return $this->model->deleteReview();
    }

    public function deleteArticle():int{
        return $this->model->deleteArticle();
    }

    public function confirmArticle():int{
        return $this->model->confirmArticle();
    }

    public function revokeArticle():int{
        return $this->model->revokeArticle();
    }
}

?>