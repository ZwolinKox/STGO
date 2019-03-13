<?php
    require_once('config.php');

    GameMail::sendMail(Post::get('adresat'), $_SESSION['uid'], strip_tags(Post::get('tresc')));
    URL::to("poczta.php");

?>