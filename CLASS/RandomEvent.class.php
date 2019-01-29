<?php
    //Klasa słynnych zdażeń losowych

    class RandomEvent {
        //Spotkanie dresów
        static public function Dresy() {
            $correct = rand(1, 3);
            $userChoice = DatabaseManager::selectBySQL('SELECT team FROM users WHERE id='.Session::get('uid'))[0]['team'];
            
            if($correct == $userChoice)
            {
                echo '<h3 style="color: lightgreen;">Spotykasz dresów, jednak okazuje się ze to twoje ziomki!';
            }
            else
            {
                echo '<h3 style="color: red;">Spotykasz dresów, są to niestety fani drużyny: ';
                switch($correct)
                {
                    case 1: echo '<h3 style="color: red;">LKS 1908 Nędza</h3>'; break;
                    case 2: echo '<h3 style="color: red;">LKS Zgoda Zawada Książęca</h3>'; break;
                    case 3; echo '<h3 style="color: red;">KS Unia Racibórz</h3>'; break;
                }
                
                DatabaseManager::updateTable('users', ['statHp' => 'statHp-50'], ['id' => $_SESSION['uid']]);

                if(DatabaseManager::selectBySQL("SELECT * FROM users WHERE id=".$_SESSION['uid'])[0]['statHp'] <= 0)
                    UserManager::death();
            }
        }
        //Wpadnięcie pod auto
        static public function Auto() {
            
            if(!DatabaseManager::selectBySQL('SELECT boolVest FROM users WHERE id='.Session::get('uid'))[0]['boolVest']) {
                echo '<h3 style="color: red;">Wpadłeś pod auto!</h3>';
                UserManager::death();
            } else {
                echo '<h3 style="color: lightgreen;">Wpadłbyś pod auto, ale miałeś na sobie kamizelkę odblaskową!</h3>';
            }
            
            
        }
        //Wypadek na siłowni ze sztangą
        static public function Sztanga() {
            echo '<h3 style="color: red;">Twoje ciało okazało się zbyt słabe!</h3>';
            UserManager::death();
        
        }

    }

?>