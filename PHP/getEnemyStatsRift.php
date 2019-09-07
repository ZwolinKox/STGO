<?php

require_once 'config.php';


if(!isset($_POST['co']))
    die();

if($_POST['co'] == 'startFight') {
    $_SESSION['winWithMonster'] = false;
    $_SESSION['fight'] = true;
    unset($_POST['co']);
}

if($_POST['co'] == 'getEnemyStats') {
    $_SESSION['enemyInfo']['enemyArmorProcent'] = ($_SESSION['enemyInfo']['enemyArmor'] / $_SESSION['enemyInfo']['enemyMaxArmor']) * 100;
    $_SESSION['enemyInfo']['enemyHpProcent'] = ($_SESSION['enemyInfo']['enemyHp'] / $_SESSION['enemyInfo']['enemyMaxHp']) * 100;

    unset($riftEnemy, $riftEnemyStat);
    die(json_encode($_SESSION['enemyInfo']));
}

elseif ($_POST['co'] == "Ucieczka") {
    $_SESSION['fight'] = false;
    unset($_SESSION['fight']);
    die('yes');
}

elseif ($_POST['co'] == 'Cios') {
    $playerStats = DatabaseManager::selectBySQL("SELECT * FROM users WHERE id=".$_SESSION['uid'])[0];
    $playerWeapon = DatabaseManager::selectBySQL("SELECT items.* FROM items, users WHERE items.id = users.eqMainHand AND users.id=".$_SESSION['uid'])[0];
    
    //$enemyDmg =  $_SESSION['enemyInfo']['enemyDamage'];
    //Różnorodność w zadawanym damage pomysł Sarny
    $enemyDmg = $_SESSION['enemyInfo']['enemyDamage'] + ((rand(1, 25) / 100) * $_SESSION['enemyInfo']['enemyDamage']);
    
    $playerDmg = ($playerStats['statStrength'] / 100 ) * $playerWeapon['addStrenght'] + ($playerStats['statIntelect'] / 100 ) * $playerWeapon['addIntelect'] + $playerWeapon['addDamage'];

    if($_SESSION['enemyInfo']['enemyArmor'] > 0) {
        $_SESSION['enemyInfo']['enemyArmor'] -= $playerDmg;

        if($_SESSION['enemyInfo']['enemyArmor'] < 0)
        {
            $_SESSION['enemyInfo']['enemyArmor'] = 0;
        }

    } else {
        $_SESSION['enemyInfo']['enemyHp'] -= $playerDmg;
    }

    DatabaseManager::updateTable('users', ['statHp' => "statHp-$enemyDmg"], ['id' => $_SESSION['uid']]);

    if(DatabaseManager::selectBySQL("SELECT statHp FROM users WHERE id=".$_SESSION['uid'])[0]['statHp'] <= 0) {
        Action::setHp($_SESSION['hpBeforeRift']);

        if(DatabaseManager::selectBySQL("SELECT boolRift FROM users WHERE id=".$_SESSION['uid'])[0]['boolRift'] == 0)
        {
            Action::addCoin(Rift::prize($_SESSION['enemyInfo']['level']));
            DatabaseManager::updateTable('users', ['boolRift' => 1], ['id' => $_SESSION['uid']]);
        }

        die('lose');
    }
    elseif ($_SESSION['enemyInfo']['enemyHp'] <= 0) {
        if(!$_SESSION['winWithMonster'])
        {
            $_SESSION['enemyInfo']['enemyHp'] = 0;
            $_SESSION['winWithMonster'] = true;

            $_SESSION['fight'] = false;
            //unset($_SESSION['fight']);
    
            //Tutaj daj kod przejscie do nastepnego przeciwnika

            if(DatabaseManager::selectBySQL("SELECT riftLevel FROM users WHERE id=".$_SESSION['uid'])[0]['riftLevel'] < $_SESSION['enemyInfo']['level'])
            {
                DatabaseManager::updateTable('users', ['riftLevel' => $_SESSION['enemyInfo']['level']], ['id' => $_SESSION['uid']]);
            }

            $riftEnemy = new RiftEnemy($_SESSION['enemyInfo']['level']+1);
            $riftEnemyStats = $riftEnemy->getStat();
            unset($_SESSION['enemyInfo']);
                    
            $_SESSION['enemyInfo']['enemyHp'] = $riftEnemyStats['hp'];
            $_SESSION['enemyInfo']['enemyMaxHp'] = $riftEnemyStats['hp'];
            $_SESSION['enemyInfo']['enemyArmor'] = $riftEnemyStats['armor'];
            $_SESSION['enemyInfo']['enemyMaxArmor'] = $riftEnemyStats['armor'];
            $_SESSION['enemyInfo']['enemyDamage'] = $riftEnemyStats['damage'];
            $_SESSION['enemyInfo']['level'] = $riftEnemyStats['level'];
            $_SESSION['riftEnemy'] = serialize($riftEnemy);
            unset($riftEnemy);
            //$_SESSION['winWithMonster'] = false;

            die('win');
            //header('Location: fightRift.php');
        }
    }
        
    else {
        if($_SESSION['enemyInfo']['enemyHp'])

        die("<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        Przeciwnik zadał Ci obrażenia równe $enemyDmg
        Zadałeś przeciwnikowi obrażenia równe $playerDmg
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
        </div>");
    } 
}