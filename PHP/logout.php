<?php
require_once 'config.php';


if(isset($_SESSION['fight']) && $_SESSION['fight']) {
    if(basename($_SERVER['PHP_SELF']) != 'fight.php' && basename($_SERVER['PHP_SELF']) != 'fight.php')
        URL::to('fight.php');
        exit();
}

$um = new UserManager;

$um->LogOut();

unset($_SESSION['fight']);

header('Location: index.php');