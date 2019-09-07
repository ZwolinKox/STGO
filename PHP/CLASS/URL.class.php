<?php

class URL {
    private function __construct() {

    }

    public static function to($locationName) {
        header('Location: '.$locationName);
    }

    public static function get() {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }
    
    public static function parse($url, $component = -1) {
        return parse_url($url, $component);
    }

    public static function getMetaTags($fileName, $uip = null) {
        return get_meta_tags($fileName, $uip);
    }
}