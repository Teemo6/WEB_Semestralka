<?php

require_once(DIR_CONTROLLERS."AController.php");

class LoginController extends AController {
    public function fetchData():array{
        $fetchData['uzivatel'] = $this->db->getAllUsers();
        return $fetchData;
    }
}

?>