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

    die(json_encode($stats));
}

