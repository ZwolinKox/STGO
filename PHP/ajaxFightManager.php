<?php

require_once 'config.php';
$enemyId;

if(Post::get('co') == 'client') {

    $fightInfo = DatabaseManager::selectBySQL('SELECT * FROM pvpqueue WHERE client='.$_SESSION['uid'].' AND host > 0 AND status=0');
    if($fightInfo != false) {

        $seconds['time'] = strtotime($fightInfo[0]['seconds']) - time();

        die(json_encode($seconds));
    }
    else 
        die('no');
        
}

elseif (Post::get('co') == 'allAccept') {
    $accept = DatabaseManager::selectBySQL('SELECT hostAccept, clientAccept, client, host FROM pvpqueue WHERE host='.$_SESSION['uid'].' OR client='.$_SESSION['uid'])[0];


    if($accept['hostAccept'] && $accept['clientAccept']) {
        if($accept['host'] == $_SESSION['uid']) {
            DatabaseManager::updateTable('pvpqueue', ['status' => 1], ['host' => $accept['host'], 'client' => $accept['client'], 'status' => 0]);
            DatabaseManager::insertInto('fight', ['playerOne' => $accept['host'], 'playerTwo' => $accept['client'], 'round' => $accept['host'], 'playerOneLastRound' => 'now() + INTERVAL 15 SECOND', 'playerTwoLastRound' => 'now() + INTERVAL 15 SECOND'], "");
        }

        die('yes');
        
    }
        
    die('no');
}

elseif(Post::get('co') == 'clientAccept') {
    DatabaseManager::updateTable('pvpqueue', ['clientAccept' => true], ['client' => $_SESSION['uid']]);
}

elseif(Post::get('co') == 'hostAccept') {
    DatabaseManager::updateTable('pvpqueue', ['hostAccept' => true], ['host' => $_SESSION['uid']]);
}

elseif(Post::get('co') == 'host') {

    
    if(!isset($_SESSION['enemyFound']) || !$_SESSION['enemyFound']) {
        $yourLp = DatabaseManager::selectBySQL("SELECT userLeaguePoints WHERE id=".$_SESSION['uid'])[0]['userLeaguePoints'];
        //ABS(users.userLeaguePoints - $yourLp) <= 100 AND
        $goodEnemys = DatabaseManager::selectBySQL("SELECT * FROM pvpqueue WHERE host=0 AND status=0");

        
        if($goodEnemys != false) {
            
            $enemyId = rand(0, count($goodEnemys)-1);
            $enemyId = $goodEnemys[$enemyId]['id'];
            DatabaseManager::updateTable('pvpqueue', ['seconds' => "now() + INTERVAL 15 SECOND", 'host' => $_SESSION['uid']], ['id' => $enemyId]);
            $_SESSION['enemyFound'] = true;
            $seconds['time'] = strtotime(DatabaseManager::selectBySQL("SELECT seconds FROM pvpqueue WHERE id=$enemyId")[0]['seconds']) - time();
            die(json_encode($seconds));
        }
        
        die('no');
    }

    if(isset($_SESSION['enemyFound']) && $_SESSION['enemyFound'])
    {
        $seconds['time'] = strtotime(DatabaseManager::selectBySQL("SELECT seconds FROM pvpqueue WHERE host=".$_SESSION['uid'])[0]['seconds']) - time();
        die(json_encode($seconds));
    }
    
    
    die('no');
    
}