<?php

require_once 'config.php';

if(Post::get('co') == 'client') {

    $fightInfo = DatabaseManager::selectBySQL('SELECT * FROM queue WHERE client='.$_SESSION['uid'].' AND host > 0 AND status=0');
    if($fightInfo != false) {

        $seconds = strtotime($fightInfo[0]['seconds']) - time();
        die($seconds);
    }
    else 
        die('no');
        
}

elseif(Post::get('co') == 'host') {

    $_SESSION['enemyFound'] = false;
    if(!isset($_SESSION['enemyFound']) || !$_SESSION['enemyFound']) {
        $yourLp = DatabaseManager::selectBySQL("SELECT userLeaguePoints WHERE id=".$_SESSION['uid'])[0]['userLeaguePoints'];
        //ABS(users.userLeaguePoints - $yourLp) <= 100 AND
        $goodEnemys = DatabaseManager::selectBySQL("SELECT * FROM queue WHERE host=0 AND status=0");
        
        if($goodEnemys != false) {
            $enemyId = rand(0, count($goodEnemys)-1);
            DatabaseManager::updateTable('queue', ['host' => $_SESSION['uid'], 'seconds' => 'now() + INTERVAL 15 SECOND'], ['client' => $enemyId]);
            $_SESSION['enemyFound'] = true;
            die(strtotime(DatabaseManager::selectBySQL('SELECT seconds WHERE host='.$_SESSION['uid'])[0]['seconds'] - time()));
        }  
    }

    if(isset($_SESSION['enemyFound']) && $_SESSION['enemyFound'])
    {
        die(strtotime(DatabaseManager::selectBySQL('SELECT seconds WHERE host='.$_SESSION['uid']) - time()));
    }
    
    
    die('no');
    
}