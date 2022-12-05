<?php

// Nazev databaze
const DB_HOST = "localhost";
const DB_NAME = "web_semestralka";
const DB_USER = "root";
const DB_PASS = "";

// Nazev tabulek
const TABLE_UZIVATEL = "uzivatel";
const TABLE_OPRAVNENI = "opravneni";

// Adresare projektu
const DIR_UTILITY = "util/";
const DIR_MODELS = "models/";
const DIR_VIEWS = "views/";
const DIR_CONTROLLERS = "controllers/";

// Defaultni stranka
const DEFAULT_WEB_PAGE = "clanky";

// Vsechny stranky webu
const WEB_PAGES = array(
    "clanky" => array(
        "file_name" => "clanky-hlavni",
        "class_name" => "clanky-hlavni",
    ),
    "registrace" => array(
        "file_name" => "login-registrace",
        "class_name" => "login-registrace",
    ),
    "prihlaseni" => array(
        "file_name" => "login-prihlaseni",
        "class_name" => "login-prihlaseni",
    ),
);

?>
