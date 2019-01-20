<?php
require_once 'config.php';

$um = new UserManager;

$um->LogOut();

unset($_SESSION['fight']);

header('Location: index.php');