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
        //Sklepik szkolny
        else if(Post::get('co') == 'hamburger')
        {
            ButtonFunc::sklepikBurger();
        }
        else if(Post::get('co') == 'tost')
        {
            ButtonFunc::sklepikTost();
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
        //McDonald
        else if(Post::get('co') == 'burgerslysz')
        {
            ButtonFunc::jedzBurger();
        }
        else if(Post::get('co') == 'bigslysz')
        {
            ButtonFunc::jedzBig();
        }
        //Aldi
        else if(Post::get('co') == 'kamizelka')
        {
            ButtonFunc::buyVest();
        }
        //Stacja benzynowa
        else if(Post::get('co') == 'hotdog')
        {
            ButtonFunc::hotdog();
        }
        else if(Post::get('co') == 'sklep')
        {
            TradeManager::buyById(Post::get('id'));
        }
    }

?>