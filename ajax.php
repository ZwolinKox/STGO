<?php

require_once 'config.php';

    if(Post::exist('co'))
    {
        //Toaleta
        if(Post::get('co') == 'jedyneczka')
        {
            ButtonFunc::jedyneczka();
        }
        else if(Post::get('co') == 'dwojeczka')
        {
            ButtonFunc::dwojeczka();
        }
        //Biblioteka
        else if(Post::get('co') == 'horror')
        {
            ButtonFunc::czytaj('horror');
        }
        else if(Post::get('co') == 'przygodowa')
        {
            ButtonFunc::czytaj('przygodowa');
        }
        else if(Post::get('co') == 'naukowa')
        {
            ButtonFunc::czytaj('naukowa');
        }
    }

?>