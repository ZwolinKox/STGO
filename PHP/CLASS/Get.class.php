<?php

class Get {

    private function __construct () {

    }

    static public function exist($name) {
        return isset($_GET[$name]);
    }

    static public function get($name) {
        if(isset($_GET[$name]))
            return $_GET[$name];
        else
            return NULL;
    }

    static public function destroy() {
        unset($_GET);
    }

    static public function set($name, $value) {
        $_GET[$name] = $value;
    }

    static public function size($name) {
        return count($_GET);
    }

    static public function unset($name) {
        unset($_GET[$name]);
    }

    static public function empty() {
        return isset($_GET);
    }

    static public function isArray() {
        return is_array($_GET);
    }
}