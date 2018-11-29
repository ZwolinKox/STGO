<?php
class UserManager {
    protected $login;
    protected $pass;
    protected $mail;
    protected $id;
    public function LogIn($LOGIN, $pass) { //przyjmujemy w formularza login i hasło
        
        $this->login = $LOGIN; //przypisanie loginu
        $this->pass = $pass; //przypisanie hasła
        
        if(self::isExist() && count(self::isExist()) > 0) { //sprawdzenie czy metoda isExist wyszukała użytkownika - wyszukała, logujemy
             $id = self::getIdByUsername(); //pobranie id użytkownika
             $this->id = $id; //przypisanie id
           
            
            self::log_in(); //ustawienie sesji
            return $this->login;
            
        } else {
            
            return false; //nie znaleziono takiego użytkownika
            
        }
        
    }
    protected function isExist() {
        $arr = DatabaseManager::selectBySQL("SELECT * FROM users WHERE username='".$this->login."' AND pass='".md5($this->pass)."' LIMIT 1");
        return $arr; //zwrócenie tablicy
    }
    protected function getIdByUsername() {
        $array = DatabaseManager::selectBySQL("SELECT * FROM users WHERE username='".$this->login."' AND pass='".md5($this->pass)."' LIMIT 1");
        foreach($array as $key) {
            $id = $key['id'];
        }
        return $id;
    }
    protected function log_in() {
        $_SESSION['uid'] = $this->id;
        $_SESSION['logged'] = true;
    }
    protected function LogOut() {
        $_SESSION['uid'] = false;
        $_SESSION['logged'] = false;
        
        unset($_SESSION);
    }
    public function CreateUser($POST) {
        if(!empty($POST) && is_array($POST)) {
            $res = DatabaseManager::insertInto("users", array("username"=>addslashes($POST['username']), "pass"=>md5($POST['pass']), "email"=>addslashes($POST['email']))); //dodanie użytkownika do bazy danych
            if($res) {
                return true;
            }
            else {
                return false;
            }
              
        }
        else {
            return false;
        }
   
    }
}