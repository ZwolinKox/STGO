<?php

class View {
    private function __construct() {

    }

    public static function get($viewName) {
        $view = File::read($viewName.".view.php");

        return $view;
    }

}