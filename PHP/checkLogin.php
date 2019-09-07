<?php

if(isset($_SESSION['fight']) && $_SESSION['fight']) {
    if(basename($_SERVER['PHP_SELF']) != 'fight.php' && basename($_SERVER['PHP_SELF']) != 'fight.php')
        URL::to('fight.php');
}

if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false)
    header('Location: index.php');


if(DatabaseManager::selectBySQL('SELECT * FROM fight WHERE status=0 AND (playerOne='.$_SESSION['uid'].' OR playerTwo='.$_SESSION['uid'].')')) {
    URL::to('pvp.php');
    exit();
}

?>

