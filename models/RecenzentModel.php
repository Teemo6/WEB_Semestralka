<?php

require_once(DIR_MODELS."DatabaseModel.php");

class RecenzentModel extends DatabaseModel{
    /**
     * Vrátí všechny schválené články
     */
    public function getAllArticles():array{
        $sql = "SELECT clanek.*, uzivatel.jmeno FROM clanek
                INNER JOIN uzivatel ON clanek.clanek_id_uzivatel = uzivatel.id_uzivatel
                WHERE schvalen = '1'";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $res = $query->fetchAll();
        return $res;
    }
}

?>