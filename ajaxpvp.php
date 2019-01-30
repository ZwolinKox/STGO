<?php

require_once 'config.php';


if(!isset($_POST['co']))
    die();

$fightId = DatabaseManager::selectBySQL('SELECT id FROM fight WHERE status=0 AND playerOne='.$_SESSION['uid'].' OR playerTwo='.$_SESSION['uid'])[0]['id'];
$enemyId = DatabaseManager::selectBySQL('SELECT playerOne, playerTwo FROM fight WHERE playerOne='.$_SESSION['uid'].' OR playerTwo='.$_SESSION['uid'])[0];
$playerNumber;
$enemyNumber;

if($enemyId['playerOne'] == $_SESSION['uid']) {
    $enemyId = $enemyId['playerTwo'];
    $playerNumber = 'playerOne';
    $enemyNumber = "playerTwo";
}
else {
    $enemyId = $enemyId['playerOne'];
    $playerNumber = 'playerTwo';
    $enemyNumber = "playerOne";
}

if($_POST['co'] == 'getEnemyStats') {

    $fightInfo = DatabaseManager::selectBySQL("SELECT * FROM fight WHERE id=".$fightId)[0];

    $enemyStats = DatabaseManager::selectBySQL('SELECT statHp, username, userLeaguePoints, statStrength, statIntelect, eqMainHand, maxHp, team 
    from users WHERE users.id='.$enemyId)[0];

    $enemyStats['enemyHpProcent'] = ($enemyStats['statHp'] / $enemyStats['maxHp']) * 100;
    $enemyStats['eqMainHand'] = DatabaseManager::selectBySQL('SELECT name FROM items WHERE id='.$enemyStats['eqMainHand'])[0]['name'];

    if($enemyStats['eqMainHand'] == null)
        $enemyStats['eqMainHand'] = 'Brak broni';

    if($fightInfo['round'] == $_SESSION['uid'])
        $enemyStats['time'] = strtotime($fightInfo[$playerNumber.'LastRound']) - time();
    else
        $enemyStats['time'] = strtotime($fightInfo[$enemyNumber.'LastRound']) - time();

    if($fightInfo['round'] == $_SESSION['uid'])
        $enemyStats['roundInfo'] = "Twoja tura!";
    else
        $enemyStats['roundInfo'] = "Tura przeciwnika!";

    $enemyStats['fightInfo'] = $fightInfo;

    die(json_encode($enemyStats));
}
elseif ($_POST['co'] == "Ucieczka") {
    if(DatabaseManager::selectBySQL("SELECT slyszCoin FROM users WHERE id=".$_SESSION['uid'])[0]['slyszCoin'] >= 200) {
        DatabaseManager::updateTable('users', ['slyszCoin' => "slyszCoin-200", "userEnergy" => "0"], ['id' => $_SESSION['uid']]);
        $_SESSION['fight'] = false;
        unset($_SESSION['fight']);
        die('yes');
    }

}

elseif ($_POST['co'] == 'Cios') {
    
    if(DatabaseManager::selectBySQL("SELECT * FROM fight WHERE id=".$fightId)[0]['round'] == $_SESSION['uid'])
    {
        $playerStats = DatabaseManager::selectBySQL("SELECT * FROM users WHERE id=".$_SESSION['uid'])[0];
        $playerWeapon = DatabaseManager::selectBySQL("SELECT items.* FROM items, users WHERE items.id = users.eqMainHand AND users.id=".$_SESSION['uid'])[0];
        $playerDmg = ($playerStats['statStrength'] / 100 ) * $playerWeapon['addStrenght'] + ($playerStats['statIntelect'] / 100 ) * $playerWeapon['addIntelect'] + $playerWeapon['addDamage'];
    
        DatabaseManager::updateTable('users', ['statHp' => "statHp-$playerDmg"], ['id' => $enemyId]);
    
        DatabaseManager::updateTable('fight', ['round' => $enemyId, $playerNumber.'LastRound' => 'NOW() + INTERVAL 15 SECOND']);

        if(DatabaseManager::selectBySQL("SELECT statHp FROM users WHERE id=".$_SESSION['uid'])[0]['statHp'] <= 0) {
            die('lose');
        }
        elseif (DatabaseManager::selectBySQL("SELECT * FROM users WHERE id=".$enemyId)[0]['statHp'] <= 0) {
    
            DatabaseManager::updateTable('users', ['userLeaguePoints' => "xpPoints+20"], ['id' => $_SESSION['uid']]);
    
            die('win');
        }
        else {
    
            die("<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            Zadałeś przeciwnikowi obrażenia równe $playerDmg
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
            </div>");
        }


    }
  
}




