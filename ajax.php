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
            ButtonFunc::czytajHorror();
        }
        else if(Post::get('co') == 'przygodowa')
        {
            ButtonFunc::czytajPrzygoda();
        }
        else if(Post::get('co') == 'naukowa')
        {
            ButtonFunc::czytajNauka();
        }
    }

?>