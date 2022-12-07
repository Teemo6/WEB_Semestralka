<?php

class mySession{
    public static function start(){
        session_start();
    }

    public static function set($key, $value){
        $_SESSION[$key] = $value;
    }

    public static function isSet($key):bool{
        return isset($_SESSION[$key]);
    }

    public static function get($key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
        return null;
    }

    public static function unset($key){
        unset($_SESSION[$key]);
    }

    public static function destroy(){
        session_destroy();
    }
}

?>