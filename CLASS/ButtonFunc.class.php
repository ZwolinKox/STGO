<?php

    //Klasa, której zadanie polega na ułątwieniu pracy z AJAXEM i szybkim wpisywaniem informacji do bazy danych
    class ButtonFunc {

        //Metody wykorzystywane w szkole w toalecie
        static public function jedyneczka() {

            $stats = DatabaseManager::selectBySQL('SELECT statHp, userEnergy FROM users WHERE id='.$_SESSION['uid'])[0];
            
            if($stats['statHp'] > 1 && $stats['userEnergy'] < 100)
            {
                DatabaseManager::updateTable('users', ['statHp' => 'statHp-1'], ['id' => $_SESSION['uid']]);
                DatabaseManager::updateTable('users', ['userEnergy' => 'userEnergy+1'], ['id' => $_SESSION['uid']]);
            }

 
        }

        static public function dwojeczka() {
            $stats = DatabaseManager::selectBySQL('SELECT statHp, userEnergy FROM users WHERE id='.$_SESSION['uid'])[0];

            if($stats['statHp'] < $stats['maxHp'] && $stats['userEnergy'] > 1) {
                DatabaseManager::updateTable('users', ['statHp' => 'statHp+1'], ['id' => $_SESSION['uid']]);
                DatabaseManager::updateTable('users', ['userEnergy' => 'userEnergy-1'], ['id' => $_SESSION['uid']]);
            }
            
        }

        //Metody wykorzystywane w sklepiku szkolnym
        static public function sklepikBurger() {
            if(DatabaseManager::selectBySQL("SELECT slyszCoin FROM users WHERE id=".$_SESSION['uid'][0]['slyszCoin']) < 50)
            {
                echo '<h3 style="color: red;">Nie masz tyle Słysz Coinów!</h3>';
            }
            else
            {
                if(DatabaseManager::selectBySQL("SELECT boolBuff FROM users WHERE id=".$_SESSION['uid'][0]['boolBuff']) == 0)
                    {
                        //DatabaseManager::updateTable('users', ['buffData' => '25', 'buffType' => 'strength', 'boolBuff' => '1', 'slyszCoin' => 'slyszCoin-50', 'statStrength' => 'statStrength+25'], ['id' => $_SESSION['uid']]);

                        DatabaseManager::updateTable('users', ['buffData' => '25'], ['id' => $_SESSION['uid']]);
                        DatabaseManager::updateTable('users', ['buffType' => 'strength'], ['id' => $_SESSION['uid']]);
                        DatabaseManager::updateTable('users', ['boolBuff' => '1'], ['id' => $_SESSION['uid']]);
                        DatabaseManager::updateTable('users', ['statStrength' => 'statStrength+25'], ['id' => $_SESSION['uid']]);
                        DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-50'], ['id' => $_SESSION['uid']]);
                    }
                    else
                    {
                        echo '<h3 style="color: red;">Masz już buffa!</h3>';
                    }
            }
        }
        static public function sklepikTost() {
            if(DatabaseManager::selectBySQL("SELECT slyszCoin FROM users WHERE id=".$_SESSION['uid'][0]['slyszCoin']) < 50)
            {
                echo '<h3 style="color: red;">Nie masz tyle Słysz Coinów!</h3>';
            }
            else
            {
                if(DatabaseManager::selectBySQL("SELECT boolBuff FROM users WHERE id=".$_SESSION['uid'][0]['boolBuff']) == 0)
                    {
                        //DatabaseManager::updateTable('users', ['buffData' => '25', 'buffType' => 'strength', 'boolBuff' => '1', 'slyszCoin' => 'slyszCoin-50', 'statStrength' => 'statStrength+25'], ['id' => $_SESSION['uid']]);

                        DatabaseManager::updateTable('users', ['buffData' => '25'], ['id' => $_SESSION['uid']]);
                        DatabaseManager::updateTable('users', ['buffType' => 'Intelect'], ['id' => $_SESSION['uid']]);
                        DatabaseManager::updateTable('users', ['boolBuff' => '1'], ['id' => $_SESSION['uid']]);
                        DatabaseManager::updateTable('users', ['statIntelect' => 'statIntelect+25'], ['id' => $_SESSION['uid']]);
                        DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-50'], ['id' => $_SESSION['uid']]);
                    }
                    else
                    {
                        echo '<h3 style="color: red;">Masz już buffa!</h3>';
                    }
            }     
        }

        static public function sklepikKawa() {
            if(DatabaseManager::selectBySQL("SELECT slyszCoin FROM users WHERE id=".$_SESSION['uid'][0]['slyszCoin']) < 50)
            {
                echo '<h3 style="color: red;">Nie masz tyle Słysz Coinów!</h3>';
            }
            else
            {
                DatabaseManager::updateTable('users', ['statHp' => 'statHp+25'], ['id' => $_SESSION['uid']]);
                DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-50'], ['id' => $_SESSION['uid']]);
            }
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
						if(DatabaseManager::selectBySQL('SELECT userEnergy FROM users WHERE id='.$_SESSION['uid'])[0]['userEnergy'] >= 10) {
							DatabaseManager::updateTable('users', ['userEnergy' => 'userEnergy-10'], ['id' => $_SESSION['uid']]);
							DatabaseManager::updateTable('users', ['statIntelect' => 'statIntelect+'.$add], ['id' => $_SESSION['uid']]);
						}

                    }break;
                    case 'przygodowa':
                    {
						if(DatabaseManager::selectBySQL('SELECT userEnergy FROM users WHERE id='.$_SESSION['uid'])[0]['userEnergy'] >= 15) {
							DatabaseManager::updateTable('users', ['userEnergy' => 'userEnergy-15'], ['id' => $_SESSION['uid']]);
							DatabaseManager::updateTable('users', ['statIntelect' => 'statIntelect+1'], ['id' => $_SESSION['uid']]);
						}

                    }break;
                    case 'naukowa':
                    {
                        $add = rand(2, 4);
						if(DatabaseManager::selectBySQL('SELECT userEnergy FROM users WHERE id='.$_SESSION['uid'])[0]['userEnergy'] >= 20) {
							DatabaseManager::updateTable('users', ['userEnergy' => 'userEnergy-20'], ['id' => $_SESSION['uid']]);
							DatabaseManager::updateTable('users', ['statIntelect' => 'statIntelect+'.$add], ['id' => $_SESSION['uid']]); 
						}

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
			if(DatabaseManager::selectBySQL('SELECT statStrength FROM users WHERE id='.$_SESSION['uid'])[0]['statStrength'] > 1 && DatabaseManager::selectBySQL('SELECT slyszCoin FROM users WHERE id='.$_SESSION['uid'])[0]['slyszCoin'] >= 15) {
				DatabaseManager::updateTable('users', ['statStrength' => 'statStrength-1'], ['id' => $_SESSION['uid']]);
				DatabaseManager::updateTable('users', ['maxHp' => 'maxHp+1', 'slyszCoin' => 'slyszCoin-15'], ['id' => $_SESSION['uid']]);
			}

        }

        static public function jedzBig() {
			if(DatabaseManager::selectBySQL('SELECT maxHp FROM users WHERE id='.$_SESSION['uid'])[0]['maxHp'] > 1 &&
              DatabaseManager::selectBySQL('SELECT slyszCoin FROM users WHERE id='.$_SESSION['uid'])[0]['slyszCoin'] >= 15) {
				DatabaseManager::updateTable('users', ['statStrength' => 'statStrength+1'], ['id' => $_SESSION['uid']]);
				DatabaseManager::updateTable('users', ['maxHp' => 'maxHp-1', 'slyszCoin' => 'slyszCoin-15'], ['id' => $_SESSION['uid']]);
			}

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

        static public function pcUpgrade(){
            $currentPcLevel = DatabaseManager::selectBySQL("SELECT levelkoparka FROM users WHERE id=".$_SESSION['uid'])[0]['levelkoparka'];
            if($currentPcLevel < 5)
            {
                if(DatabaseManager::selectBySQL("SELECT slyszCoin FROM users WHERE id=".$_SESSION['uid'])[0]['slyszCoin'] < $currentPcLevel*500)
                {
                    echo '<h3 style="color: red;">Nie masz tyle Słysz Coinów!</h3><br>';
                }
                else
                {
                    DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-'.$currentPcLevel*500], ['id' => $_SESSION['uid']]);
                    DatabaseManager::updateTable('users', ['levelkoparka' => 'levelkoparka+1'], ['id' => $_SESSION['uid']]);
                }
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
				if(DatabaseManager::selectBySQL('SELECT statHp FROM users WHERE id='.$_SESSION['uid'])[0]['statHp']+10 <=
				DatabaseManager::selectBySQL('SELECT maxHp FROM users WHERE id='.$_SESSION['uid'])[0]['maxHp']) {
					DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-20'], ['id' => $_SESSION['uid']]);
					DatabaseManager::updateTable('users', ['statHp' => 'statHp+10'], ['id' => $_SESSION['uid']]); 
				}

            }
        }
    }
?>