<?php
require_once('config.php');

Anticheat::generateToken();
Anticheat::saveIpAddress();

header('Location: dom.php');
?>