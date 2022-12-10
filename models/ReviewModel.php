<?php

require_once(DIR_MODELS."DatabaseModel.php");

class ReviewModel extends DatabaseModel{
    public function getAllArticles():array{
        $sql = "SELECT clanek.*, uzivatel.jmeno FROM clanek
                INNER JOIN uzivatel ON clanek.clanek_id_uzivatel = uzivatel.id_uzivatel";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $res = $query->fetchAll();
        return $res;
    }
}

?>