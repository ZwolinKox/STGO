<?php

class Action {
    //Coinsy
    static public function addCoin($value) {
        DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin+'. $value], ['id' => $_SESSION['uid']]);
    }

    static public function delCoin($value) {
        DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-'. $value], ['id' => $_SESSION['uid']]);
    }

    static public function checkCoin($value) {
        if(DatabaseManager::selectBySQL("SELECT slyszCoin FROM users WHERE id=".$_SESSION['uid'])[0]['slyszCoin'] < $value)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    //Energia
    static public function addEnergy($value) {
        DatabaseManager::updateTable('users', ['userEnergy' => 'userEnergy+'. $value], ['id' => $_SESSION['uid']]);
    }

    static public function delEnergy($value) {
        DatabaseManager::updateTable('users', ['userEnergy' => 'userEnergy-'. $value], ['id' => $_SESSION['uid']]);
    }

    static public function checkEnergy($value) {
        if(DatabaseManager::selectBySQL("SELECT userEnergy FROM users WHERE id=".$_SESSION['uid'])[0]['userEnergy'] < $value)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    static public function setEnergy($value) {
        DatabaseManager::updateTable('users', ['userEnergy' => $value], ['id' => $_SESSION['uid']]);
    }

    //Zdrowie
    static public function addHp($value) {
        DatabaseManager::updateTable('users', ['statHp' => 'statHp+'. $value], ['id' => $_SESSION['uid']]);
    }

    static public function delHp($value) {
        DatabaseManager::updateTable('users', ['statHp' => 'statHp-'. $value], ['id' => $_SESSION['uid']]);
    }
}

