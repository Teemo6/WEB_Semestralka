<?php

// Nazev databaze
const DB_HOST = "localhost";
const DB_NAME = "web_semestralka";
const DB_USER = "root";
const DB_PASS = "";

// Nazev tabulek
const TAB_UZIVATEL = "uzivatel";
const TAB_OPRAVNENI = "opravneni";

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
        "view" => "clanky-hlavni",
        "controller" => "EmptyController",
    ),
    "registrace" => array(
        "view" => "login-registrace",
        "controller" => "LoginController",
    ),
    "prihlaseni" => array(
        "view" => "login-prihlaseni",
        "controller" => "LoginController",
    ),
    "odhlaseni" => array(
        "view" => "clanky-hlavni",
        "controller" => "LoginController",
    ),
    "profil" => array(
        "view" => "profil",
        "controller" => "ProfilController",
    ),
);

?>
