<?php
class Raid {
    public static function getRaidData($raidId) {
        return DatabaseManager::selectBySQL('SELECT * FROM raid WHERE id='.$raidId);
    }

    public static function invitePlayer($userId) {
        DatabaseManager::insertInto('raidinv', ['visible' => 1, 'leaderId' => $_SESSION['uid'], 'invitedId' => $userId]);
    }
}
?>