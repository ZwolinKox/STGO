<?php
class Anticheat {
    public static function checkDate() {
        $then = DatabaseManager::selectBySQL("SELECT lastSunday FROM users WHERE id=".$_SESSION['uid'])[0]['lastSunday'];
        $then = new DateTime($then);

        $now = new DateTime();

        $sinceThen = $then->diff($now);

        $sec = $sinceThen->s;

        if($sinceThen->s <= 5)
        {
            DatabaseManager::updateTable('users', ['banCheck' => "now() + INTERVAL 24 HOUR", 'statHp' => 1], ['id' => $_SESSION['uid']]);
            header('Location: logout.php');
        }
    }
}
?>