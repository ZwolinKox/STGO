<?php

class Upload {
    private function __construct() {

    }

    public static function getSize($filesName) {
        return getimagesize($_FILES[$filesName]['tmp_name']);
    }

    public static function get($fileName) {
        return $_FILES[$fileName];
    }

    public static function exist($fileName) {
        return file_exists($fileName);
    }

    public static function size($fileName) {
        return $_FILES[$fileName]['size'];
    }

    public static function getType($fileName) {
        return strtolower(pathinfo($fileName,PATHINFO_EXTENSION));
    }
}