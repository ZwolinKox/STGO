<?php
class Miner {
    public static function build() {
        if(Action::checkCoin(1000))
        {
            $elementsValue = DatabaseManager::selectBySQL('SELECT collectElik, collectElyk, collectInfo, collectEnod FROM users WHERE id='.$_SESSION['uid']);
            
            if(($elementsValue[0]['collectElik']>=100)&&($elementsValue[0]['collectElyk']>=100)&&($elementsValue[0]['collectInfo']>=100)&&($elementsValue[0]['collectEnod']>=100))
            {
                DatabaseManager::updateTable('users', ['collectElik' => 'collectElik-100'], ['id' => $_SESSION['uid']]);
                DatabaseManager::updateTable('users', ['collectElyk' => 'collectElyk-100'], ['id' => $_SESSION['uid']]);
                DatabaseManager::updateTable('users', ['collectInfo' => 'collectInfo-100'], ['id' => $_SESSION['uid']]);
                DatabaseManager::updateTable('users', ['collectEnod' => 'collectEnod-100'], ['id' => $_SESSION['uid']]);
                DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-1000'], ['id' => $_SESSION['uid']]);
                DatabaseManager::updateTable('users', ['boolKoparka' => 1], ['id' => $_SESSION['uid']]);
                DatabaseManager::updateTable('users', ['levelkoparka' => 1], ['id' => $_SESSION['uid']]);
            }
        }
    }

    public static function upgrade() {
        $elementsValue = DatabaseManager::selectBySQL('SELECT collectElik, collectElyk, collectInfo, collectEnod, levelkoparka FROM users WHERE id='.$_SESSION['uid']);

        if($elementsValue[0]['levelkoparka']<5)
        {
            if(($elementsValue[0]['collectElik']>=100)&&($elementsValue[0]['collectElyk']>=100)&&($elementsValue[0]['collectInfo']>=100)&&($elementsValue[0]['collectEnod']>=100))
            {
                DatabaseManager::updateTable('users', ['collectElik' => 'collectElik-100'], ['id' => $_SESSION['uid']]);
                DatabaseManager::updateTable('users', ['collectElyk' => 'collectElyk-100'], ['id' => $_SESSION['uid']]);
                DatabaseManager::updateTable('users', ['collectInfo' => 'collectInfo-100'], ['id' => $_SESSION['uid']]);
                DatabaseManager::updateTable('users', ['collectEnod' => 'collectEnod-100'], ['id' => $_SESSION['uid']]);
                DatabaseManager::updateTable('users', ['levelkoparka' => 'levelkoparka+1'], ['id' => $_SESSION['uid']]);
            }
        }
    }

    public static function mineCoins() {
        $users = DatabaseManager::selectBySQL("SELECT id, levelkoparka FROM users WHERE boolkoparka=1");

        for($i=0; $i<count($users); $i++)
        {
            $usersId = $users[$i]['id'];

            switch($users[$i]['levelkoparka'])
            {
                case 1: $gain = 100; break;
                case 2: $gain = 200; break;
                case 3: $gain = 400; break;
                case 4: $gain = 700; break;
                case 5: $gain = 1000; break;
            }

            DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin+'. $gain], ['id' => $usersId]);

            unset($usersId);
            unset($gain);
        }
    }

    public static function minerGain($level) {
        switch($level)
        {
            case 1: return 100; break;
            case 2: return 200; break;
            case 3: return 400; break;
            case 4: return 700; break;
            case 5: return 1000; break;
        }
    }
}
?>