<?php

class Action {
    //Prosty dostep do zmiennych
    static public function getCoins() {
        return DatabaseManager::selectBySQL("SELECT slyszCoin FROM users WHERE id=".$_SESSION['uid'])[0]['slyszCoin'];
    }

    static public function getHp() {
        return DatabaseManager::selectBySQL("SELECT statHp FROM users WHERE id=".$_SESSION['uid'])[0]['statHp'];
    }

    static public function getEnergy() {
        return DatabaseManager::selectBySQL("SELECT userEnergy FROM users WHERE id=".$_SESSION['uid'])[0]['userEnergy'];
    }

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

        if(Action::getHp() <= 0)
        {
            UserManager::death();
        }
    }

    //Sila
    static public function addStrength($value) {
        DatabaseManager::updateTable('users', ['statStrength' => 'statStrength+'. $value], ['id' => $_SESSION['uid']]);
    }

    //Intelekt
    static public function addIntelect($value) {
        DatabaseManager::updateTable('users', ['statIntelect' => 'statIntelect+'. $value], ['id' => $_SESSION['uid']]);
    }

    //MaxHP
    static public function addMaxHp($value) {
        DatabaseManager::updateTable('users', ['maxHp' => 'maxHp+'. $value], ['id' => $_SESSION['uid']]);
    }

    static public function delMaxHp($value) {
        DatabaseManager::updateTable('users', ['maxHp' => 'maxHp-'. $value], ['id' => $_SESSION['uid']]);
    }
}

