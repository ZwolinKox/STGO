<?php

class GameMail {
    private function __construct () {}

    static public function sendMail($mailTo, $mailFrom, $mailText) {
        DatabaseManager::insertInto("Mail", ["whoReceive" => $mailTo, "whoSend" => $mailFrom, "messText" => $mailText]);
    }

    static public function refreshMail($id) {
        $allMails = DatabaseManager::selectBySQL("SELECT messText, whoSend FROM Mail WHERE spaghet ");
    }

    static public function deleteMail() {}
}