<?php

class Post {

    private function __construct () {

    }

    static public function exist($name) {
        return isset($_POST[$name]);
    }

    static public function get($name) {
            return $_POST[$name];
    }

    static public function destroy() {
        unset($_POST);
    }

    static public function set($name, $value) {
        $_POST[$name] = $value;
    }

    static public function size($name) {
        return count($_POST);
    }

    static public function unset($name) {
        unset($_POST[$name]);
    }

    static public function empty() {
        return !isset($_POST);
    }

    static public function isArray() {
        return is_array($_POST);
    }
}