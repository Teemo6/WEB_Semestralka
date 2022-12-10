<?php

require_once(DIR_MODELS."DatabaseModel.php");

class ReviewModel extends DatabaseModel{
    public function getArticle():array{
        $clanekID = htmlspecialchars($_GET['id']);

        $sql = "SELECT clanek.*, uzivatel.jmeno FROM clanek
                INNER JOIN uzivatel ON clanek.clanek_id_uzivatel = uzivatel.id_uzivatel
                WHERE id_clanek = :id";
        $query = $this->pdo->prepare($sql);
        $query->execute(array(
            "id" => $clanekID,
        ));
        $res = $query->fetchAll();
        return $res;
    }
}

?>