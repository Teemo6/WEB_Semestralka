<?php

require_once(DIR_MODELS."DatabaseModel.php");

class LoginModel extends DatabaseModel{
    public function registrace(){
        // Zadané parametry
        $rJmeno = htmlspecialchars($_POST["rJmeno"]);
        $rEmail = htmlspecialchars($_POST["rEmail"]);
        $rHeslo = htmlspecialchars($_POST["rHeslo"]);
        $rHeslo2 = htmlspecialchars($_POST["rHeslo2"]);

        // Login nebo email je zabraný
        $sql = "SELECT jmeno, email FROM uzivatel WHERE jmeno = :jmeno OR email = :email";
        $query = $this->pdo->prepare($sql);
        $query->execute(array(
            "jmeno" => $rJmeno,
            "email" => $rEmail,
        ));
        $res = $query->fetch();
        if($res != null){
            if($res['jmeno'] == $rJmeno){
                return 1;
            }
            if($res['email'] == $rEmail){
                return 2;
            }
        }

        // Hesla se neshodují
        if($rHeslo != $rHeslo2){
            return 3;
        }

        // Zahashuj heslo
        $rHeslo = password_hash($rHeslo, PASSWORD_BCRYPT);

        // Registruj uživatele
        $sql = "INSERT INTO uzivatel(`jmeno`, `heslo`, `email`) VALUES ( :jmeno, :heslo, :email)";
        $query = $this->pdo->prepare($sql);
        $query->execute(array(
            "jmeno" => $rJmeno,
            "heslo" => $rHeslo,
            "email" => $rEmail,
        ));
        return 0;
    }

    public function prihlaseni(){
        // Zadané parametry
        $lJmeno = htmlspecialchars($_POST["lJmeno"]);
        $lHeslo = htmlspecialchars($_POST["lHeslo"]);

        // Vyber data
        $sql = "SELECT uzivatel.*, opravneni.nazev FROM uzivatel 
              INNER JOIN opravneni ON uzivatel.uzivatel_id_opravneni = opravneni.id_opravneni
              WHERE jmeno = :jmeno";
        $query = $this->pdo->prepare($sql);
        $query->execute(array(
            "jmeno" => $lJmeno,
        ));
        $res = $query->fetch();

        // Přihlašovací jméno neexistuje
        if($res == null){
            return 1;
        }

        // Hesla nejsou stejná
        if(!password_verify($lHeslo, $res['heslo'])){
            return 1;
        }

        // Přihlaš uživatele
        mySession::set("id", $res["id_uzivatel"]);
        mySession::set("jmeno", $res["jmeno"]);
        mySession::set("uroven", $res["uzivatel_id_opravneni"]);
        mySession::set("opravneni", $res["nazev"]);
        return 0;
    }

    public function odhlaseni(){
        mySession::destroy();
    }
}

?>