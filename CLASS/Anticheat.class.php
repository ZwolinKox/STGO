<?php
require_once('config.php');

class Anticheat {
    public static function checkDate() {
        $then = DatabaseManager::selectBySQL("SELECT lastSunday FROM users WHERE id=".$_SESSION['uid'])[0]['lastSunday'];
        $then = new DateTime($then);

        $now = new DateTime();

        $sinceThen = $then->diff($now);

        $sec = $sinceThen->s;

        if($sinceThen->s <= 5)
        {
            $banInfo = "Jestes podejrzewany o używanie bota!";
            DatabaseManager::updateTable('users', ['banInfo' => 1], ['id' => $_SESSION['uid']]);
            DatabaseManager::updateTable('users', ['banCheck' => "now() + INTERVAL 24 HOUR"], ['id' => $_SESSION['uid']]);            
            header('Location: logout.php');
        }
    }

    public static function forceLogout()
    {
        session_destroy();
        header('Location: index.php');
    }

    public static function getIpAddress() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    private static function getIpAddr() {
        if(!empty($_SERVER['HTTP_CLIENT_IP']))
        {
            return $_SERVER['HTTP_CLIENT_IP'];
        }
        else if(!empty($_SERVER['HTTP_X_FORWARDER_FOR']))
        {
            return $_SERVER['HTTP_X_FORWARDER_FOR'];
        }
        else
        {
            return $_SERVER['REMOTE_ADDR'];
        }
    }


    public static function saveIpAddress() {
        DatabaseManager::updateTable('users', ['authIp' => getIpAddress()], ['id' => $_SESSION['uid']]);
    }

    public static function compareIpAddress() {
        if(getIpAddr() == DatabaseManager::selectBySQL("SELECT authIp FROM users WHERE id=".$_SESSION['uid'])[0]['authIp'])
        {
            return true;
        }
        forceLogout();
        return false;
    }

    public static function generateToken() {
        define("CHARS", "abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ");
        //$charList = str_split("abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ");
        $authToken = "auth";

        for($i=0; $i<25; $i++)
        {
            //$authToken .= $charList[rand(0, sizeof($charList))];
            $authToken .= CHARS[rand(0, 61)];
        }
        DatabaseManager::updateTable('users', ['authToken' => $authToken], ['id' => $_SESSION['uid']]);
        setcookie("authToken", $authToken); 
    }

    public static function checkToken() {
        if(isset($_COOKIE["authToken"]))
        {
            if($_COOKIE["authToken"] == DatabaseManager::selectBySQL("SELECT authToken FROM users WHERE id=".$_SESSION['uid'])[0]['authToken'])
            {
                return true;
            }
        }
        forceLogout();
        return false;
    }
}
?>