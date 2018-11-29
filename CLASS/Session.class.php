<?php 

class Session {
    private function __construct() {

    }

    static public function get($name) {
        if(isset($_SESSION[$name]))
            return $_SESSION[$name];
        else
            return NULL;
    }

    static public function destroy() {
        session_destroy();
    }

    static public function start() {
        session_start();
    }

    static public function set($name, $value) {
        $_SESSION[$name] = $value;
    }

    static public function exist($name) {
        return isset($_SESSION[$name]);
    }

    static public function size($name) {
        return count($_SESSION);
    }

    static public function unset($name) {
        unset($_SESSION[$name]);
    }

    static public function empty() {
        return isset($_SESSION);
    }

    static public function isArray() {
        return is_array($_SESSION);
    }

    static public function mustLogin() {
        if(!self::exist('logged')){
            die("Musisz się zalogować!");
        }
    }
}