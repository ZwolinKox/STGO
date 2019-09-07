<?php
    require_once('config.php');

    if(Post::exist('adminVerify'))
    {
        if(Post::exist('adminCommand'))
        {
            unset($_SESSION['shellOutput']);
            //banowanie
            if(substr(Post::get('adminCommand'), 0, -(strlen(Post::get('adminCommand'))-3)) == 'ban')
            {
                $userid = UserManager::idByNick(substr(Post::get('adminCommand'), 4, strlen(Post::get('adminCommand'))));

                DatabaseManager::updateTable('users', ['banInfo' => 1], ['id' => $userid]);
                DatabaseManager::updateTable('users', ['banCheck' => "now() + INTERVAL 24 HOUR"], ['id' => $userid]);

                unset($_POST['adminCommand'], $_POST['adminVerify']);
                $_SESSION['shellOutput'] = 'Gracz '.$nick.' został zbanowany na 24h';
            }
            //datadump
            else if(substr(Post::get('adminCommand'), 0, -(strlen(Post::get('adminCommand'))-8)) == 'datadump')
            {
                $userid = UserManager::idByNick(substr(Post::get('adminCommand'), 9, strlen(Post::get('adminCommand'))));

                unset($_POST['adminCommand'], $_POST['adminVerify']);
                $_SESSION['shellOutput'] = DatabaseManager::selectBySQL("SELECT * FROM users WHERE id=".$userid)[0];
            }
            //wiadomosc do wszystkich
            else if(substr(Post::get('adminCommand'), 0, -(strlen(Post::get('adminCommand'))-9)) == 'broadcast')
            {
                $text = substr(Post::get('adminCommand'), 10, strlen(Post::get('adminCommand')));
                $allPlayers = DatabaseManager::selectBySQL("SELECT id FROM users");

                for($i=0; $i<$arrayValue; $i++)
                {
                    $receiveId = $allPlayers[$i]['id'];
                    DatabaseManager::insertInto("mail", ["whoReceive" => $receiveId, "whoSend" => 0, "messDate" => date("H:i d-m"), "messText" => $text]);
                }
            }
            //wlaczenie lub wylaczenie mozliwosci zalogowania sie do gry (prace techniczne)
            else if(substr(Post::get('adminCommand'), 0, -(strlen(Post::get('adminCommand'))-4)) == 'open')
            {
                $status = substr(Post::get('adminCommand'), 4, strlen(Post::get('adminCommand')));

                DatabaseManager::updateTable('admin', ['serverOpen' => $status], ['id' => 1]);

                unset($_POST['adminCommand'], $_POST['adminVerify']);
                
                if(DatabaseManager::selectBySQL("SELECT serverOpen FROM admin WHERE id=1")[0]['serverOpen'] == 1)
                {
                    $_SESSION['shellOutput'] = "Serwer jest włączony!";
                }
                else
                {
                    $_SESSION['shellOutput'] = "Serwer jest wyłączony!";
                }
            }
            //wykonanie kopii zapasowej najważniejszych informacji z tabeli users
            else if(substr(Post::get('adminCommand'), 0, -(strlen(Post::get('adminCommand'))-6)) == 'backup')
            {
                Admin::backupNow();
                unset($_POST['adminCommand'], $_POST['adminVerify']);
                $_SESSION['shellOutput'] = 'Wykonano kopie zapasową tabeli users!';
            }

            //informacje o poleceniach
            else if(substr(Post::get('adminCommand'), 0, -(strlen(Post::get('adminCommand'))-4)) == 'help')
            {
                unset($_POST['adminCommand'], $_POST['adminVerify']);
                $_SESSION['shellOutput'] = 'ban nick - zbanowanie gracza na 24h . datadump nick - wypisanie wszystkich informacji na temat gracza . broadcast tekst - wysłanie wiadomości do wszystkich graczy . open value - podajemy wartosc 1 albo 0 zeby wlaczyc wylaczyc serwer';
            }
        }
    }
?>