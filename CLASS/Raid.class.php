<?php
class Raid {
    public static function getRaidData($raidId) {
        return DatabaseManager::selectBySQL('SELECT * FROM raid WHERE id='.$raidId);
    }

    public static function invitePlayer($userId) {
        DatabaseManager::insertInto('raidinv', ['visible' => 1, 'leaderId' => $_SESSION['uid'], 'invitedId' => $userId]);
    }

    public static function getAllPlayerStat($users) {

        $user2id = $users[0]['id'];
        $user3id = $users[1]['id'];
        $user4id = $users[2]['id'];
        $user5id = $users[3]['id'];

        DatabaseManager::insertInto('raidsession', ['tour' => 0, 'leaderId' => $_SESSION['uid'], 'userTwoId' => $user2id, 'userThreeId' => $user3id, 'userFourId']);
        
        
        /* 
        `id` int(11) NOT NULL,
  `tour` int(11) NOT NULL,
  `leaderId` int(11) NOT NULL,
  `userTwoId` int(11) NOT NULL,
  `userThreeId` int(11) NOT NULL,
  `userFourId` int(11) NOT NULL,
  `userFiveId` int(11) NOT NULL,
  `userOneHp` int(11) NOT NULL,
  `userTwoHp` int(11) NOT NULL,
  `userThreeHp` int(11) NOT NULL,
  `userFourHp` int(11) NOT NULL,
  `userFiveHp` int(11) NOT NULL,
  `currentFight` int(11) NOT NULL,
  `currentEnemyArmor` int(11) NOT NULL,
  `currentEnemyHp` int(11) NOT NULL
        */


    }
}
?>