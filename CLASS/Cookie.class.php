<?php

class Cookie {
    private function __cosntruct() {

    }

    public static function set($name, $value, $expire = 0, $path="", $secure = false, $httponly = false) {
        setcookie($name, $value, $expire, $path, $secure, $httponly);
    }

    public static function delete($name) {
        unset($_COOKIE[$name]);
    }

    public static function destroy() {
        unset($_COOKIE);
    }

    public static function isArray() {
        return is_array[$_COOKIE];
    }

    public static function exist() {
        return isset($_COOKIE);
    }

    public static function unset($name) {
        unset($_COOKIE[$name]);
    }

    public static function get($name) {
        if(isset($_COOKIE[$name]))
            return $_COOKIE[$name];
        else
            return NULL;
    }
}