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

    /**
     * Vrátí všechny informace o recenzi uživatele
     */
    public function getArticles():array{
        $sql = "SELECT recenze.*, clanek.*, uzivatel.* FROM recenze
                INNER JOIN clanek ON recenze.recenze_id_clanek = clanek.id_clanek
                INNER JOIN uzivatel ON clanek.clanek_id_uzivatel = uzivatel.id_uzivatel
                WHERE recenze_id_uzivatel = :id_uzivatel";
        $query = $this->pdo->prepare($sql);
        $query->execute(array(
            "id_uzivatel" => mySession::get('id'),
        ));
        $res = $query->fetchAll();
        return $res;
    }

   /*
    * Zkusí ohodnotit článek, vrací číslo výsledku
    *   0 Článek se ohodnotil
    *   1 Chybí ohodnocení některé kategorie
    *   2 Neplatné hodnocení
    *   3 Článek je již tímto uživatelem ohodnocen
    */
    public function rateArticle():int{
        $recenzeID = htmlspecialchars($_POST['id_clanek']);
        $kvalita = htmlspecialchars($_POST['kvalita']);
        $jazyk = htmlspecialchars($_POST['jazyk']);
        $originalita = htmlspecialchars($_POST['originalita']);

        // Kategorie neni vyplnena
        if($kvalita == 0 || $jazyk == 0 || $originalita == 0){
            return 1;
        }

        // Neplatná hodnota hodnocení
        if($kvalita < 1 || $kvalita > 5 || $jazyk < 1 || $jazyk > 5 || $originalita < 1 || $originalita > 5){
            return 2;
        }

        // Clanek je jiz ohodnocen
        $sql = "SELECT * FROM recenze WHERE recenze_id_clanek = :id_clanek AND recenze_id_uzivatel = :id_uzivatel";
        $query = $this->pdo->prepare($sql);
        $query->execute(array(
            "id_clanek" => $recenzeID,
            "id_uzivatel" => mySession::get('id'),
        ));
        $res = $query->fetch();
        if($res['hotova'] == 1){
            return 3;
        }

        // Přidej hodnocení
        $sql = "UPDATE recenze SET kvalita = :kvalita, jazyk = :jazyk, originalita = :originalita, hotova = '1' WHERE recenze_id_clanek = :id_clanek AND recenze_id_uzivatel = :id_uzivatel";
        $query = $this->pdo->prepare($sql);
        $query->execute(array(
            "kvalita" => $kvalita,
            "jazyk" => $jazyk,
            "originalita" => $originalita,
            "id_clanek" => $recenzeID,
            "id_uzivatel" => mySession::get('id'),
        ));
        return 0;
    }
}

?>