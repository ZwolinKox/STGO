<?php

    //Klasa, której zadanie polega na ułątwieniu pracy z AJAXEM i szybkim wpisywaniem informacji do bazy danych
    class ButtonFunc {

        //Metody wykorzystywane w szkole w toalecie
        static public function jedyneczka() {
            DatabaseManager::updateTable('users', ['statHp' => 'statHp-1'], ['id' => $_SESSION['uid']]);
            DatabaseManager::updateTable('users', ['userEnergy' => 'userEnergy+1'], ['id' => $_SESSION['uid']]);
        }

        static public function dwojeczka() {
            DatabaseManager::updateTable('users', ['statHp' => 'statHp+1'], ['id' => $_SESSION['uid']]);
            DatabaseManager::updateTable('users', ['userEnergy' => 'userEnergy-1'], ['id' => $_SESSION['uid']]);
        }

        //Metody wykorzystywane w szkole w bibliotece
        static public function czytaj($gatunek) {
            if(DatabaseManager::selectBySQL("SELECT slyszCoin FROM users WHERE id=".$_SESSION['uid'])[0]['slyszCoin'] < 15)
            {
                echo '<h3 style="color: red;">Nie masz tyle Słysz Coinów!</h3><br>';
            }
            else
            {
                DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-15'], ['id' => $_SESSION['uid']]);
                switch($gatunek)
                {
                    case 'horror':
                    {
                        $add = rand(0, 2);
                        DatabaseManager::updateTable('users', ['userEnergy' => 'userEnergy-10'], ['id' => $_SESSION['uid']]);
                        DatabaseManager::updateTable('users', ['statIntelect' => 'statIntelect+'.$add], ['id' => $_SESSION['uid']]);
                    }break;
                    case 'przygodowa':
                    {
                        DatabaseManager::updateTable('users', ['userEnergy' => 'userEnergy-10'], ['id' => $_SESSION['uid']]);
                        DatabaseManager::updateTable('users', ['statIntelect' => 'statIntelect+1'], ['id' => $_SESSION['uid']]);
                    }break;
                    case 'naukowa':
                    {
                        $add = rand(2, 4);
                        DatabaseManager::updateTable('users', ['userEnergy' => 'userEnergy-10'], ['id' => $_SESSION['uid']]);
                        DatabaseManager::updateTable('users', ['statIntelect' => 'statIntelect+'.$add], ['id' => $_SESSION['uid']]); 
                    }break;
                }
                if(isset($add))
                {
                    unset($add);
                }
            }
        }

        //Metody wykorzystywane w szkole w parku w McDonalds
        static public function jedzBurger() {
            DatabaseManager::updateTable('users', ['statStrength' => 'statStrength-1'], ['id' => $_SESSION['uid']]);
            DatabaseManager::updateTable('users', ['maxHp' => 'maxHp+1'], ['id' => $_SESSION['uid']]);
        }

        static public function jedzBig() {
            DatabaseManager::updateTable('users', ['statStrength' => 'statStrength+1'], ['id' => $_SESSION['uid']]);
            DatabaseManager::updateTable('users', ['maxHp' => 'maxHp-1'], ['id' => $_SESSION['uid']]);
        }

        //Metody wykorzystywane w szkole w parku w Aldi
        static public function buyVest(){
            if(DatabaseManager::selectBySQL("SELECT slyszCoin FROM users WHERE id=".$_SESSION['uid'])[0]['slyszCoin'] < 500)
            {
                echo '<h3 style="color: red;">Nie masz tyle Słysz Coinów!</h3><br>';
            }
            else
            {
                DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-500'], ['id' => $_SESSION['uid']]);
                DatabaseManager::updateTable('users', ['boolVest' => 1], ['id' => $_SESSION['uid']]); 
            }
        }

        //Metody wykorzystywane w szkole w parku w Stacji benzynowej
        static public function hotdog(){
            if(DatabaseManager::selectBySQL("SELECT slyszCoin FROM users WHERE id=".$_SESSION['uid'])[0]['slyszCoin'] < 20)
            {
                echo '<h3 style="color: red;">Nie masz tyle Słysz Coinów!</h3><br>';
            }
            else
            {
                DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-20'], ['id' => $_SESSION['uid']]);
                DatabaseManager::updateTable('users', ['statHp' => 'statHp+10'], ['id' => $_SESSION['uid']]); 
            }
        }


    }


?>