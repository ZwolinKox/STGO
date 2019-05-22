<?php
    require_once('config.php');

    if(Post::exist('messageTo'))
    {
        if(Post::exist('messageText'))
        {
            if(Post::get('messageText') != "")
            {
                if(Post::get('messageSc') <= Action::getCoins())
                {
                    GameMail::sendMail(Post::get('messageTo'), $_SESSION['uid'], strip_tags(Post::get('messageText')), Post::get('messageSc'));
                }
            }
        }
    }

    if(Post::exist('messageDelete'))
    {
        GameMail::deleteMail();
    }

    Post::unset('messageTo');
    Post::unset('messageText');
    Post::unset('messageSc');
    Post::unset('messageDelete');
?>