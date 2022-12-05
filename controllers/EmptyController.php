<?php

require_once(DIR_CONTROLLERS."AController.php");

class EmptyController extends AController {
    public function fetchData():array{
        return [];
    }
}

?>