<?php


class JSON {
    private function __construct() {

    }

    public static function encode($object, $option = 0, $depth = 512) {
        return json_encode($object, $option, $depth);
    }

    public static function decode($json, $assoc = false, $depth = 512, $option = 0) {
        return json_decode($json);
    }

    public static function setHeader() {
        header("Content-Type: application/json; charset=UTF-8");
    }
}