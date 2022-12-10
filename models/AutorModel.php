<?php

require_once(DIR_MODELS."DatabaseModel.php");

class AutorModel extends DatabaseModel{
    /**
     * Vrátí články vytvořené přihlášeným uživatelem
     */
    public function getMyArticles():array{
        $sql = "SELECT clanek.*, uzivatel.jmeno FROM clanek
                INNER JOIN uzivatel ON clanek.clanek_id_uzivatel = uzivatel.id_uzivatel
                WHERE clanek_id_uzivatel = :id_uzivatel
                ORDER BY schvalen ASC";
        $query = $this->pdo->prepare($sql);
        $query->execute(array(
            'id_uzivatel' => mySession::get('id'),
        ));
        $res = $query->fetchAll();
        return $res;
    }

    /**
     * Zkusí vytvořit nový článek, vrací číslo výsledku
     *   0 Článek se vytvořil
     *   1 Článek se stejným názvem existuje
     *   2 Soubor má špatnou příponu
     *   3 Soubor se nepovedlo nahrát na server
     */
    public function newArticle():int{
        // Zadané parametry
        $cNazev = htmlspecialchars($_POST["cNazev"]);
        $cAbstrakt = htmlspecialchars($_POST["cAbstrakt"]);
        $cSoubor = basename($_FILES["cSoubor"]["name"]);

        // Článek s tímto názvem existuje
        $sql = "SELECT nazev FROM clanek WHERE nazev = :nazev";
        $query = $this->pdo->prepare($sql);
        $query->execute(array(
            "nazev" => $cNazev,
        ));
        $res = $query->fetch();
        if($res != null){
            return 1;
        }

        // Kontrola přípony souboru
        $extension = pathinfo($cSoubor, PATHINFO_EXTENSION);
        if (strtolower($extension) != "pdf") {
            return 2;
        }

        // Nahraj soubor na server
        $nazevSouboru = uniqid('PDF_', true);
        if(!move_uploaded_file($_FILES["cSoubor"]["tmp_name"], DIR_UTILITY."pdf/".$nazevSouboru.".pdf")) {
            return 3;
        }

        // Vytvoř článek
        $sql = "INSERT INTO clanek(`clanek_id_uzivatel`, `nazev`, `abstrakt`, `soubor`) VALUES ( :id, :nazev, :abstrakt, :soubor)";
        $query = $this->pdo->prepare($sql);
        $query->execute(array(
            "id" => mySession::get('id'),
            "nazev" => $cNazev,
            "abstrakt" => $cAbstrakt,
            "soubor" => $cSoubor,
        ));
        return 0;
    }
}

?>