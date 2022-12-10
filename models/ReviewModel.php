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

    public function getReviewers():array{
        $sql = "SELECT * FROM uzivatel WHERE uzivatel_id_opravneni >= '2'";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $res = $query->fetchAll();
        return $res;
    }

    public function getReviews():array{
        $clanekID = htmlspecialchars($_GET['id']);

        $sql = "SELECT recenze.*, uzivatel.jmeno FROM recenze 
                INNER JOIN uzivatel ON recenze.recenze_id_uzivatel = uzivatel.id_uzivatel   
                WHERE recenze_id_clanek = :id";
        $query = $this->pdo->prepare($sql);
        $query->execute(array(
            "id" => $clanekID,
        ));
        $res = $query->fetchAll();
        return $res;
    }

    /**
     * Zkusí přiřadit recenzenta článku, vrací číslo výsledku
     *   0 Recenzent se přiřadil
     *   1 Recenzent už tento článek přiřazen má
     */
    public function setReviewer():int{
        $uzivatelID = htmlspecialchars($_POST['id_recenzent']);
        $clanekID = htmlspecialchars($_GET['id']);

        // Recenzent už tento článek přiřazen má
        $sql = "SELECT * FROM recenze WHERE recenze_id_uzivatel = :id_uzivatel AND recenze_id_clanek = :id_clanek";
        $query = $this->pdo->prepare($sql);
        $query->execute(array(
            "id_uzivatel" => $uzivatelID,
            "id_clanek" => $clanekID,
        ));
        $res = $query->fetch();
        if($res != null){
            return 1;
        }

        // Přiřaď recenzenta
        $sql = "INSERT INTO recenze(`recenze_id_uzivatel`, `recenze_id_clanek`) VALUES ( :id_uzivatel, :id_clanek)";
        $query = $this->pdo->prepare($sql);
        $query->execute(array(
            "id_uzivatel" => $uzivatelID,
            "id_clanek" => $clanekID,
        ));
        return 0;
    }

    public function deleteReview():int{
        $recenzeID = htmlspecialchars($_POST['recID']);

        // Proveď delete
        $sql = "DELETE FROM recenze WHERE id_recenze = :id_recenze";
        $query = $this->pdo->prepare($sql);
        $query->execute(array(
            'id_recenze' => $recenzeID,
        ));
        return 0;
    }

    /*
     * Zkusí označit článek jako schválený, vrací číslo výsledku
     *   0 Článek se schválil
     *   1 Nelze schválit článek, chybí recenze
     *   2 Nelze schválit článek, recenze nejsou hotové
     */
    public function confirmArticle():int{
        $clanekID = htmlspecialchars($_GET['id']);

        // Článek nemá všechny recenze uzavřené
        $sql = "SELECT recenze.*, uzivatel.jmeno FROM recenze 
                INNER JOIN uzivatel ON recenze.recenze_id_uzivatel = uzivatel.id_uzivatel   
                WHERE recenze_id_clanek = :id";
        $query = $this->pdo->prepare($sql);
        $query->execute(array(
            "id" => $clanekID,
        ));
        $res = $query->fetchAll();
        if($res == null){
            return 1;
        }
        foreach($res as $vys){
            if($vys['hotova'] != 1){
                return 2;
            }
        }

        $sql = "UPDATE clanek SET schvalen = '1' WHERE id_clanek = :id_clanek";
        $query = $this->pdo->prepare($sql);
        $query->execute(array(
            'id_clanek' => $clanekID,
        ));
        return 0;
    }

    /*
     * Odvolá článek, nebude poté vidět
     */
    public function revokeArticle():int{
        $clanekID = htmlspecialchars($_GET['id']);

        $sql = "UPDATE clanek SET schvalen = '0' WHERE id_clanek = :id_clanek";
        $query = $this->pdo->prepare($sql);
        $query->execute(array(
            'id_clanek' => $clanekID,
        ));
        return 0;
    }

    /*
     * Smaže článek
     */
    public function deleteArticle():int{
        $clanekID = htmlspecialchars($_GET['id']);

        // Smazání souboru na disku
        $sql = "SELECT * FROM clanek WHERE id_clanek = :id_clanek";
        $query = $this->pdo->prepare($sql);
        $query->execute(array(
            'id_clanek' => $clanekID,
        ));
        $res = $query->fetch();
        unlink(DIR_UTILITY."pdf/".$res['soubor'].".pdf");

        // Proveď delete
        $sql = "DELETE FROM clanek WHERE id_clanek = :id_clanek";
        $query = $this->pdo->prepare($sql);
        $query->execute(array(
            'id_clanek' => $clanekID,
        ));
        return 0;
    }
}

?>