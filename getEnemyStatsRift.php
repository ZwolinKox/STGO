<?php

require_once 'config.php';


if(!isset($_POST['co']))
    die();

if($_POST['co'] == 'startFight') {
    $_SESSION['fight'] = true;
    unset($_POST['co']);
}

if($_POST['co'] == 'getEnemyStats') {
    $riftEnemy = unserialize($_SESSION['riftEnemy']);
    $riftEnemyStat = $riftEnemy->getStat();

    $_SESSION['enemyInfo']['enemyArmorProcent'] = ($riftEnemyStat['armor'] / $_SESSION['enemyInfo']['enemyMaxArmor']) * 100;
    $_SESSION['enemyInfo']['enemyHpProcent'] = ($riftEnemyStat['hp'] / $_SESSION['enemyInfo']['enemyMaxHp']) * 100;

    unset($riftEnemy, $riftEnemyStat);
    die(json_encode($_SESSION['enemyInfo']));
}

elseif ($_POST['co'] == "Ucieczka") {
    $_SESSION['fight'] = false;
    unset($_SESSION['fight']);
    die('yes');
}

elseif ($_POST['co'] == 'Cios') {
    $riftEnemy = unserialize($_SESSION['riftEnemy']);
    $riftEnemyStat = $riftEnemy->getStat();
    
    $playerStats = DatabaseManager::selectBySQL("SELECT * FROM users WHERE id=".$_SESSION['uid'])[0];
    $playerWeapon = DatabaseManager::selectBySQL("SELECT items.* FROM items, users WHERE items.id = users.eqMainHand AND users.id=".$_SESSION['uid'])[0];
    $enemyDmg =  $riftEnemyStat['damage'];
    $playerDmg = ($playerStats['statStrength'] / 100 ) * $playerWeapon['addStrenght'] + ($playerStats['statIntelect'] / 100 ) * $playerWeapon['addIntelect'] + $playerWeapon['addDamage'];

    if($riftEnemyStat['hp'] > 0) {
        $riftEnemyStat['armor'] -= $playerDmg;

        if($riftEnemyStat['armor'] < 0)
            $riftEnemyStat['armor'] = 0;

    } else {
        $riftEnemyStat['hp'] -= $playerDmg;
    }

    DatabaseManager::updateTable('users', ['statHp' => "statHp-$enemyDmg"], ['id' => $_SESSION['uid']]);

    $_SESSION['riftEnemy'] = serialize($riftEnemy);

    if(DatabaseManager::selectBySQL("SELECT statHp FROM users WHERE id=".$_SESSION['uid'])[0]['statHp'] <= 0) {
        UserManager::death();
    }
    elseif ($riftEnemyStat['hp'] <= 0) {

        if(!$_SESSION['winWithMonster'])
        {
            $riftEnemyStat['hp'] = 0;
            $_SESSION['winWithMonster'] = true;
    
            //Tutaj daj kod przejscie do nastepnego przeciwnika

            $_SESSION['fight'] = false;
            unset($_SESSION['fight']);
      
            $_SESSION['win'] = true;
    
            die('win');
        }
    }
        
    else {
        if($riftEnemyStat['hp'])

        die("<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        Przeciwnik zadał Ci obrażenia równe $enemyDmg
        Zadałeś przeciwnikowi obrażenia równe $playerDmg
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
        </div>");
    }

  
}




