<?php
require_once 'config.php';

$um = new UserManager;

$um->LogOut();

header('Location: index.php');