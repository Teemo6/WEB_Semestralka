<?php

require_once(DIR_MODELS."DatabaseModel.php");

class ArticleModel extends DatabaseModel{
    public function getAllArticles():array{
        $sql = "SELECT clanek.*, uzivatel.jmeno FROM clanek
                INNER JOIN uzivatel ON clanek.clanek_id_uzivatel = uzivatel.id_uzivatel";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $res = $query->fetchAll();
        return $res;
    }

    public function getAllReviewers():array {
        $sql = "SELECT * FROM uzivatel WHERE opravneni = '2'";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $res = $query->fetchAll();
        return $res;
    }
}

?>