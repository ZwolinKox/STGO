<?php

if(isset($_POST['ajax']) && $_POST['ajax'] == 'ajax')
{
    require_once 'config.php';

    $stats = DatabaseManager::selectBySQL('SELECT * FROM users WHERE id='.$_SESSION['uid'])[0];
    $stats['pass'] = 'xxx'; //zabezpieczenie przed poznaniem hasła

    
    switch ($stats['dayWeek']) {
        case '1':
            $stats['dayWeek'] = 'poniedziałek';
            break;
            case '2':
            $stats['dayWeek'] = 'wtorek';
            break;
            case '3':
            $stats['dayWeek'] = 'środa';
            break;
            case '4':
            $stats['dayWeek'] = 'czwartek';
            break;
            case '5':
            $stats['dayWeek'] = 'piątek';
            break;
            case '6':
            $stats['dayWeek'] = 'sobota';
            break;
            case '7':
            $stats['dayWeek'] = 'niedziela';
            break;
    }

            
    switch ($stats['team']) {
        case '1':
            $stats['team'] = 'LKS 1908 Nędza';
            $stats['colorTeam'] = '#ffcd2b';
            break;
            case '2':
            $stats['team'] = 'LKS Zgoda Zawada Książęca';
            $stats['colorTeam'] = '#ff1616';
            break;
            case '3':
            $stats['team'] = 'KS Unia Racibórz';
            $stats['colorTeam'] = '#42c5f4';
    }

                
    switch ($stats['boolHardcore']) {
        case '0':
            $stats['hardcore'] = 'Normalny';
            $stats['hardcoreColor'] = 'white';
            break;
            case '1':
            $stats['hardcore'] = 'HARDCORE';
            $stats['hardcoreColor'] = 'red';
            break;
    }

    if($stats['drivingLicence'] == true)
        $stats['drivingLicence'] = "Posiadasz prawo jazdy kategorii B!";
    else
        $stats['drivingLicence'] = "";

    if($stats['eqMainHand'] == 0)
        $stats['eqMainHandName'] = "Brak broni";
    else {
        $stats['eqMainHandName'] = DatabaseManager::selectBySQL('SELECT items.name FROM users, items WHERE items.id = users.eqMainHand AND users.id='.$_SESSION['uid'])[0]['name'];
        $stats['eqMainHandName'] = EqManager::item($stats['eqMainHand'], 'colorTag').' '.EqManager::stat($stats['eqMainHand']); //test
    }

    $stats['procentHp'] = ($stats['statHp'] / $stats['maxHp']) * 100;
    $stats['procentXp'] = ($stats['xpPoints'] / $stats['maxXp']) * 100;

    $stats['username'] = UserManager::Nick('span');

    $stats['playTime'] = floor(($stats['playTime']/3600));


    die(json_encode($stats));
}

