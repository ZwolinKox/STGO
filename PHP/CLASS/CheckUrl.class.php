<?php


class CheckUrl {
    public static function check() {
       if(!isset($_SERVER['HTTP_REFERER']))
           header('Location: index.php'); 
    }
}