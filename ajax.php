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
        else if(Post::get('co') == 'changeItem') 
        {
            if(EqManager::checkHand(DatabaseManager::selectBySQL('SELECT '.$_POST['itemName'].' FROM users WHERE id='.$_SESSION['uid'])[0][$_POST['itemName']])) {
                DatabaseManager::updateTable('users', ['eqMainHand' => $_POST['itemName']], ['id' => $_SESSION['uid']]);
                unset($_POST['itemName']);
            }

        }
        else if(Post::get('co') == 'deleteItem') 
        {
            DatabaseManager::updateTable('users', [$_POST['itemName'] => 0], ['id' => $_SESSION['uid']]);
            unset($_POST['itemName']);
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