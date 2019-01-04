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
        static public function czytajHorror() {
            $add = rand(0, 2);
            DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-15'], ['id' => $_SESSION['uid']]);
            DatabaseManager::updateTable('users', ['userEnergy' => 'userEnergy-10'], ['id' => $_SESSION['uid']]);
            DatabaseManager::updateTable('users', ['statIntelect' => 'statIntelect+'.$add], ['id' => $_SESSION['uid']]);
            unset($add);
        }

        static public function czytajPrzygoda() {
            DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-15'], ['id' => $_SESSION['uid']]);
            DatabaseManager::updateTable('users', ['userEnergy' => 'userEnergy-10'], ['id' => $_SESSION['uid']]);
            DatabaseManager::updateTable('users', ['statIntelect' => 'statIntelect+1'], ['id' => $_SESSION['uid']]);
        }

        static public function czytajNauka() {
            $add = rand(2, 4);
            DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-15'], ['id' => $_SESSION['uid']]);
            DatabaseManager::updateTable('users', ['userEnergy' => 'userEnergy-10'], ['id' => $_SESSION['uid']]);
            DatabaseManager::updateTable('users', ['statIntelect' => 'statIntelect+'.$add], ['id' => $_SESSION['uid']]);
            unset($add);
        }

        

    }


?>