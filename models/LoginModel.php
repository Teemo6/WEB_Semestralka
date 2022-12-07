<?php

require_once(DIR_MODELS."DatabaseModel.php");
require_once("mySession.php");

class LoginModel extends DatabaseModel{
    public function registrace(){
        // Zadané parametry
        $rJmeno = htmlspecialchars($_POST["rJmeno"]);
        $rEmail = htmlspecialchars($_POST["rEmail"]);
        $rHeslo = htmlspecialchars($_POST["rHeslo"]);
        $rHeslo2 = htmlspecialchars($_POST["rHeslo2"]);

        // Login je zabraný
        $obj = $this->executeQuery("SELECT id_uzivatel FROM ".TAB_UZIVATEL." WHERE jmeno = '$rJmeno'");
        $res = $obj->fetchAll();
        if(count($res) > 0){
            return 1;
        }

        // Email je zabraný
        $obj = $this->executeQuery("SELECT id_uzivatel FROM ".TAB_UZIVATEL." WHERE email = '$rEmail'");
        $res = $obj->fetchAll();
        if(count($res) > 0){
            return 2;
        }

        // Hesla se neshodují
        if($rHeslo != $rHeslo2){
            return 3;
        }

        // Registruj uživatele
        $this->executeQuery("INSERT INTO ".TAB_UZIVATEL."(`jmeno`, `login`, `heslo`, `email`) VALUES ( '$rJmeno', '$rJmeno', '$rHeslo', '$rEmail')");
        return 0;
    }

    public function prihlaseni(){
        // Zadané parametry
        $lJmeno = htmlspecialchars($_POST["lJmeno"]);
        $lHeslo = htmlspecialchars($_POST["lHeslo"]);

        $obj = $this->executeQuery("SELECT * FROM ".TAB_UZIVATEL." WHERE jmeno = '$lJmeno' AND heslo = '$lHeslo'");
        $res = $obj->fetchAll();

        // Špatně zadané údaje
        if(count($res) < 1){
            return 1;
        }

        // Přihlaš uživatele
        mySession::set("id", $res[0]["id_uzivatel"]);
        mySession::set("jmeno", $res[0]["jmeno"]);
        mySession::set("opravneni", $res[0]["uzivatel_id_opravneni"]);
        return 0;
    }

    public function odhlaseni(){
        mySession::destroy();
        header("location: index.php?page=odhlaseni");
    }
}

?>