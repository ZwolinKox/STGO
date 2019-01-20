<?php

require_once 'config.php';


if(!isset($_POST['co']))
    die();

if($_POST['co'] == 'getEnemyStats') {
    $_SESSION['enemyInfo']['enemyArmorProcent'] = ($_SESSION['enemyInfo']['enemyArmor'] / $_SESSION['enemyInfo']['enemyMaxArmor']) * 100;
    $_SESSION['enemyInfo']['enemyHpProcent'] = ($_SESSION['enemyInfo']['enemyHp'] / $_SESSION['enemyInfo']['enemyMaxHp']) * 100;

    die(json_encode($_SESSION['enemyInfo']));
}
elseif ($_POST['co'] == "Ucieczka") {
    if(DatabaseManager::selectBySQL("SELECT slyszCoin FROM users WHERE id=".$_SESSION['uid'])[0]['slyszCoin'] >= 200) {
        DatabaseManager::updateTable('users', ['slyszCoin' => "slyszCoin-200", "userEnergy" => "0"], ['id' => $_SESSION['uid']]);
        die('yes');
    }

}

elseif ($_POST['co'] == 'Cios') {
    
    $playerStats = DatabaseManager::selectBySQL("SELECT * FROM users WHERE id=".$_SESSION['uid'])[0];
    $playerWeapon = DatabaseManager::selectBySQL("SELECT items.* FROM items, users WHERE items.id = users.eqMainHand AND users.id=".$_SESSION['uid'])[0];
    $enemyDmg =  $_SESSION['enemyInfo']['enemyDamage'];
    $playerDmg = ($playerStats['statStrength'] / 100 ) * $playerWeapon['addStrenght'] + ($playerStats['statIntelect'] / 100 ) * $playerWeapon['addIntelect'] + $playerWeapon['addDamage'];

    if($_SESSION['enemyInfo']['enemyArmor'] > 0) {
        $_SESSION['enemyInfo']['enemyArmor'] -= $playerDmg;

        if($_SESSION['enemyInfo']['enemyArmor'] < 0)
            $_SESSION['enemyInfo']['enemyArmor'] = 0;

    } else {
        $_SESSION['enemyInfo']['enemyHp'] -= $playerDmg;
    }

    DatabaseManager::updateTable('users', ['statHp' => "statHp-$enemyDmg"], ['id' => $_SESSION['uid']]);

    if(DatabaseManager::selectBySQL("SELECT statHp FROM users WHERE id=".$_SESSION['uid'])[0]['statHp'] <= 0) {
        UserManager::death();
    }
    elseif ($_SESSION['enemyInfo']['enemyHp'] <= 0) {
        $_SESSION['enemyInfo']['enemyHp'] = 0;

        DatabaseManager::updateTable('users', ['xpPoints' => "xpPoints+".$_SESSION['enemyInfo']['dropXp'], 'slyszCoin' => 'slyszCoin+'.$_SESSION['enemyInfo']['dropSlyszCoin']], ['id' => $_SESSION['uid']]);
        
        if(DatabaseManager::selectBySQL("SELECT xpPoints FROM users WHERE id=".$_SESSION['uid'])[0]['xpPoints']
            >= DatabaseManager::selectBySQL("SELECT maxXp FROM users WHERE id=".$_SESSION['uid'])[0]['maxXp']) 
        {
            DatabaseManager::updateTable('users', ['xpPoints' => "0", 'maxXp' => 'maxXp+100', 'userLevel' => 'userLevel+1'], ['id' => $_SESSION['uid']]);
            $_SESSION['lvlup'] = true;
        }

        //Losowanie, czy będzie drop
        if(rand(1, 20) == 3) {
            $itemDrop = rand(1, 5);

            switch ($itemDrop) {
                    case '1':
                    $itemDrop = 'dropItemOne';
                    break;
                    case '2':
                    $itemDrop = 'dropItemTwo';
                    break;
                    case '3':
                    $itemDrop = 'dropItemThree';
                    break;
                    case '4':
                    $itemDrop = 'dropItemFour';
                    break;
                    case '5':
                    $itemDrop = 'dropItemFive';
                    break;
            }

            $freeSlot = EqManager::findSpace();

            

            if($freeSlot != null) {
                DatabaseManager::updateTable('users', [$freeSlot => DatabaseManager::selectBySQL("SELECT $itemDrop FROM enemy WHERE id=".$_SESSION['enemyInfo']['id'])[0][$itemDrop]], ['id' => $_SESSION['uid']]);
            } else
                $_SESSION['enemyInfo']['isFull'] = true;

            $_SESSION['enemyInfo']['dropItem'] = DatabaseManager::selectBySQL("SELECT name FROM items, enemy WHERE items.id = enemy.$itemDrop AND enemy.id =".$_SESSION['enemyInfo']['id'])[0]['name'];

        }

        $_SESSION['fight'] = false;
        unset($_SESSION['fight']);


        $_SESSION['win'] = true;

        die('win');
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




