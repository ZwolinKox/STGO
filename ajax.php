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

        elseif(Post::get('co') == 'deleteGuildMember')
        {
            Guild::deleteGuildMemberByNumber(Post::get('member'));
        }

        elseif(Post::get('co') == 'deleteGuild')
        {
            Guild::deleteGuild();
        }

        elseif(Post::get('co') == 'leaveGuild') {
            Guild::leaveGuild();
        }

        elseif(Post::get('co') == 'inviteMember') {
            $guildName = DatabaseManager::selectBySQL("SELECT guildName FROM users WHERE id=".$_SESSION['uid'])[0]['guildName'];
            $guildInfo =  DatabaseManager::selectBySQL("SELECT * FROM guilds WHERE guildName='".$guildName."'")[0];

            if($guildInfo['guildOwner'] == $_SESSION['uid'])
            {
                
                $playerName = Post::get('playerName');
               

                $playerId = DatabaseManager::selectBySQL("SELECT id FROM users WHERE username='$playerName'")[0]['id'];

                if($playerId <= 0)
                    die("Taki gracz nie istnieje!");

                $usr = DatabaseManager::selectBySQL("SELECT id FROM ganginv WHERE playerId='$playerId' AND guildName='$guildName' AND visible=1 LIMIT 1")[0]["id"];

                if($usr >= 1)
                    die("Gracz posiada oczekujace zaproszenie przez twój gang!");

                    
                if(DatabaseManager::selectBySQL("SELECT boolGuild FROM users WHERE id=$playerId")[0]['boolGuild'] == 1)
                    die("Gracz jest już członkiem jakiejś gildii!");

                
                DatabaseManager::insertInto('ganginv', ['visible' => 1, 'guildName' => $guildName, 'playerId' => $playerId]);

                die('success');
            }

             
        }

        elseif (Post::get('co') == 'guildAccept') {

            $guildName = Post::get('guildName');
            $guildInfo =  DatabaseManager::selectBySQL("SELECT * FROM guilds WHERE guildName='".$guildName."'")[0];
            $myId = $_SESSION['uid'];

            $usr = DatabaseManager::selectBySQL("SELECT id FROM ganginv WHERE playerId='$myId' AND guildName='$guildName' AND visible=1 LIMIT 1")[0]["id"];

            if($usr <= 0)
                die("Nie posiadasz zaproszenia do tego klanu!");

                $number = null;

                    if($guildInfo['guildMemberTwo'] == 0)
                        $number = 'guildMemberTwo';

                    elseif($guildInfo['guildMemberThree'] == 0)
                        $number = 'guildMemberThree';

                    elseif($guildInfo['guildMemberFour'] == 0)
                        $number = 'guildMemberFour';

                    elseif($guildInfo['guildMemberFive'] == 0)
                        $number = 'guildMemberFive';

                    elseif($guildInfo['guildMemberSix'] == 0)
                        $number = 'guildMemberSix';

                    elseif($guildInfo['guildMemberSeven'] == 0)
                        $number = 'guildMemberSeven';

                    elseif($guildInfo['guildMemberEight'] == 0)
                        $number = 'guildMemberEight';

                    elseif($guildInfo['guildMemberNine'] == 0)
                        $number = 'guildMemberNine';

                    elseif($guildInfo['guildMemberTen'] == 0)
                        $number = 'guildMemberTen';

                if($number == null)
                    die("Klan nie posiada wolnych miejsc!");
            
                DatabaseManager::updateTable("ganginv", ['visible' => 0], ['guildName' => '"'.$guildName.'"', 'visible' => 1]);
                DatabaseManager::updateTable("users", ["guildName" => '"'.$guildName.'"', "boolGuild" => "1"], ["id" => $_SESSION['uid']]);
                DatabaseManager::updateTable('guilds', [$number => $_SESSION['uid']]);

                die('success'); 

            
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