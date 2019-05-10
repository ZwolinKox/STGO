<?php

require_once 'config.php';

    if(Post::exist('co'))
    {
		if(Post::get('co') == 'gangName')
        {		
	
			$usr = DatabaseManager::selectBySQL("SELECT id FROM guilds WHERE guildName='".Post::get('gangName')."' LIMIT 1")[0]["id"];

            if($usr >= 1)
				die("fail");
			else
				die("success");
				
        }
        
        elseif (Post::get('co') == 'createGang') {
            DatabaseManager::insertInto("guilds", ["guildName" => Post::get('gangName'), "guildOwner" => Session::get('uid')]);

            DatabaseManager::updateTable("users", ["guildName" => '"'.Post::get('gangName').'"', "boolGuild" => 1], ["id" => Session::get('uid')]);

            die("success");
        }

        //Toaleta
        elseif(Post::get('co') == 'jedyneczka')
        {
            ButtonFunc::jedyneczka();
        }
        elseif(Post::get('co') == 'dwojeczka')
        {
            ButtonFunc::dwojeczka();
        }
        //Sklepik szkolny
        elseif(Post::get('co') == 'hamburger')
        {
            ButtonFunc::sklepikBurger();
        }
        elseif(Post::get('co') == 'tost')
        {
            ButtonFunc::sklepikTost();
        }
        elseif(Post::get('co' == 'kawa'))
        {
            ButtonFunc::sklepikKawa();
        }
        //Biblioteka
        elseif(Post::get('co') == 'horror')
        {
            ButtonFunc::czytaj('horror');
        }
        elseif(Post::get('co') == 'przygodowa')
        {
            ButtonFunc::czytaj('przygodowa');
        }
        elseif(Post::get('co') == 'naukowa')
        {
            ButtonFunc::czytaj('naukowa');
        }
        elseif(Post::get('co') == 'changeItem') 
        {
            if(EqManager::checkHand(DatabaseManager::selectBySQL('SELECT '.$_POST['itemName'].' FROM users WHERE id='.$_SESSION['uid'])[0][$_POST['itemName']])) {
                DatabaseManager::updateTable('users', ['eqMainHand' => $_POST['itemName']], ['id' => $_SESSION['uid']]);
                unset($_POST['itemName']);
            }

        }
        elseif(Post::get('co') == 'deleteItem') 
        {
            DatabaseManager::updateTable('users', [$_POST['itemName'] => 0], ['id' => $_SESSION['uid']]);
            unset($_POST['itemName']);
        }
        //McDonald
        elseif(Post::get('co') == 'burgerslysz')
        {
            ButtonFunc::jedzBurger();
        }
        elseif(Post::get('co') == 'bigslysz')
        {
            ButtonFunc::jedzBig();
        }
        //Aldi
        elseif(Post::get('co') == 'kamizelka')
        {
            ButtonFunc::buyVest();
        }
        elseif(Post::get('co') == 'czesci')
        {
            ButtonFunc::pcUpgrade();
        }
        //Stacja benzynowa
        elseif(Post::get('co') == 'hotdog')
        {
            ButtonFunc::hotdog();
        }
        elseif(Post::get('co') == 'sklep')
        {
            TradeManager::buyById(Post::get('id'));
        }


    }

?>