<?php

require_once(DIR_MODELS."DatabaseModel.php");

class AdminModel extends DatabaseModel{
    public function getAllUsers():array {
        $sql = "SELECT uzivatel.*, opravneni.* FROM uzivatel
                INNER JOIN opravneni ON uzivatel.uzivatel_id_opravneni = opravneni.id_opravneni";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $res = $query->fetchAll();
        return $res;
    }

    public function getAllAuth():array {
        $sql = "SELECT * FROM opravneni";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $res = $query->fetchAll();
        return $res;
    }

    public function updateAuth():int {
        // Předané parametry
        $updUzivatel = htmlspecialchars($_POST['id_uzivatel']);
        $updRole = htmlspecialchars($_POST['id_opravneni']);

        // Uživatel má nižší úroveň něž chce změnit
        if($updRole >= mySession::get('uroven')){
            return 1;
        }

        // Uživatel chce změnit roli vyššímu uživateli
        $sql = "SELECT uzivatel_id_opravneni FROM uzivatel WHERE id_uzivatel = :id_uzivatel";
        $query = $this->pdo->prepare($sql);
        $query->execute(array(
            'id_uzivatel' => $updUzivatel,
        ));
        $res = $query->fetch();
        if($res['uzivatel_id_opravneni'] >= mySession::get('uroven')){
            return 2;
        }

        // Proveď update
        $sql = "UPDATE uzivatel SET uzivatel_id_opravneni = :opravneni WHERE id_uzivatel = :id_uzivatel";
        $query = $this->pdo->prepare($sql);
        $query->execute(array(
            'opravneni' => $updRole,
            'id_uzivatel' => $updUzivatel,
        ));
        return 0;
    }

    public function deleteUser():int {
        // Předané parametry
        $updUzivatel = htmlspecialchars($_POST['id_uzivatel']);

        // Uživatel chce smazat vyššího uživatele
        $sql = "SELECT uzivatel_id_opravneni FROM uzivatel WHERE id_uzivatel = :id_uzivatel";
        $query = $this->pdo->prepare($sql);
        $query->execute(array(
            'id_uzivatel' => $updUzivatel,
        ));
        $res = $query->fetch();
        if($res['uzivatel_id_opravneni'] >= mySession::get('uroven')){
            return 3;
        }

        // Proveď delete
        $sql = "DELETE FROM uzivatel WHERE id_uzivatel = :id_uzivatel";
        $query = $this->pdo->prepare($sql);
        $query->execute(array(
            'id_uzivatel' => $updUzivatel,
        ));
        return 0;
    }
}

?>