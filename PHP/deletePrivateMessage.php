<?php
    require_once('config.php');
    
    GameMail::deleteMail($_SESSION['uid']);
    URL::to("poczta.php");
?>