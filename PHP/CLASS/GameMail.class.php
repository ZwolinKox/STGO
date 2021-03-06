<?php

class GameMail {
    private function __construct () {}

    static public function sendMail($mailTo, $mailFrom, $mailText, $mailSlyszCoin) {
        if($mailSlyszCoin != 0)
        {
            $mailText .= ' (Przelano: '.$mailSlyszCoin.'SC!)';
            DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-'. $mailSlyszCoin], ['id' => $_SESSION['uid']]);
            DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin+'. $mailSlyszCoin], ['id' => GameMail::nameToId($mailTo)]);
        }
        DatabaseManager::insertInto("mail", ["whoReceive" => GameMail::nameToId($mailTo), "whoSend" => $mailFrom, "messDate" => date("H:i d-m"), "messText" => $mailText]);
    }

    static public function refreshMail($id) {
        $allMails = DatabaseManager::selectBySQL("SELECT messText, whoSend FROM Mail WHERE  "); // <-- dokoncz XD
    }

    //Jestem leniwy wiec te 2 metody sobie zrobiłem, mozna je potem usunąć ale na czas prac nad poczta sobie je zostawie
    static public function idToName($id) {
        return DatabaseManager::selectBySQL("SELECT username FROM users WHERE id=".$id)[0]['username'];
    }

    static private function nameToId($name) {
        return DatabaseManager::selectBySQL('SELECT id FROM users WHERE username="'.$name.'"')[0]['id'];
    }

    static public function deleteMail() {
        DatabaseManager::deleteFrom("Mail", ["whoReceive" => $_SESSION['uid']]);
    }
}