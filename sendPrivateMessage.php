<?php
    require_once('config.php');

    GameMail::sendMail(Post::get('adresat'), $_SESSION['uid'], Post::get('tresc'));
    URL::to("poczta.php");
  
?>