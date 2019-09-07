<?php 
require_once('config.php');

class Rift {
    public static function setBool() {
        $users = DatabaseManager::selectBySQL("SELECT id FROM users WHERE userLevel=30");

        for($i=0; $i<count($users); $i++)
        {
            $usersId = $users[$i]['id'];
            DatabaseManager::updateTable('users', ['boolRift' => 0], ['id' => $usersId]);
            unset($usersId);
        }
    }

    public static function prize($enemyLevel) {
        if($enemyLevel <= 5)
        {
            return 300;
        }
        else if(($enemyLevel > 5)&&($enemyLevel <= 10))
        {
            return 900;
        }
        else if(($enemyLevel > 10)&&($enemyLevel <= 20))
        {
            return 1500;
        }
        else if(($enemyLevel > 20)&&($enemyLevel < 50))
        {
            return 3000;
        }
        else
        {
            return 8000;
        }
    }
}

?>