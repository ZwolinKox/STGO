<?php
class UserManager {
    protected $login;
    protected $pass;
    protected $mail;
    protected $id;

    public static function death() {

        $lvl = DatabaseManager::selectBySQL("SELECT userLevel FROM users WHERE id=".$_SESSION['uid'])[0]['userLevel'];
        
        if($lvl <= 5)
        {
            $add = 5;
        }
        else if(($lvl > 5)&&($lvl <= 15))
        {
            $add = 10;
        }
        else if(($lvl > 15)&&($lvl <= 25))
        {
            $add = 30;
        }
        else if(($lvl > 25)&&($lvl <= 29))
        {
            $add = 60;
        }
        else
        {
            $add = 240;
        }
            
        if(DatabaseManager::selectBySQL("SELECT boolHardcore FROM users WHERE id=".$_SESSION['uid'])[0]['boolHardcore']) {
            DatabaseManager::updateTable('users', ["dayWeek" => 1, "dayGame" => 1, "slyszCoin" => 100, "xpPoints" => 0, "userLevel" => 1, "userLeaguePoints" => 0, "userEnergy" => 100, "statStrength" => 0, "statIntelect" => 0, 
            "statArmor" => 0, "statHp" => 100, "statDamage" => 1, "maxHp" => 100, "maxXp" => 100, "eqMainHand" => '0'], ['id' => $_SESSION['uid']]);

            DatabaseManager::updateTable('users', ['banInfo' => 0], ['id' => $_SESSION['uid']]);
            DatabaseManager::updateTable('users', ['banCheck' => "now() + INTERVAL 2 HOUR", 'statHp' => 1], ['id' => $_SESSION['uid']]);
        }
            
        else
            DatabaseManager::updateTable('users', ['banInfo' => 0], ['id' => $_SESSION['uid']]);
            DatabaseManager::updateTable('users', ['banCheck' => "now() + INTERVAL $add MINUTE", 'statHp' => 1], ['id' => $_SESSION['uid']]);

        die('Umarłeś! Jesteś beznadziejnym Słyszem!');

        $_SESSION['uid'] = false;
        $_SESSION['logged'] = false;
        $_SESSION['fight'] = false;
        
        unset($_SESSION);
        session_destroy();
    }

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
    public function LogOut() {
        $_SESSION['uid'] = false;
        $_SESSION['logged'] = false;
        
        unset($_SESSION);
        session_destroy();
    }
    public function CreateUser($POST) {
        if(!empty($POST) && is_array($POST)) {

            $login = $POST["login"];
            $usr = DatabaseManager::selectBySQL("SELECT id FROM users WHERE username='$login' LIMIT 1")[0]["id"];

            if($usr >= 1)
                return false;

            $hardcore;

            if($POST['hardcore'] == 2)
                $hardcore = true;
            else
                $hardcore = false;

            $res = DatabaseManager::insertInto("users", array("username"=>addslashes($POST['login']), "pass"=>md5($POST['pass']), "email"=>addslashes($POST['email']), "team"=>addslashes($POST['team']),
            "dayWeek" => 1, "dayGame" => 1, "slyszCoin" => 100, "xpPoints" => 0, "userLevel" => 1, "userLeaguePoints" => 0, "userEnergy" => 100, "statStrength" => 0, "statIntelect" => 0, 
            "statArmor" => 0, "statHp" => 100, "statDamage" => 1, "maxHp" => 100, "maxXp" => 100, "boolHardcore"=>$hardcore
        )); //dodanie użytkownika do bazy danych
            
            
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

    public static function Nick($htmlTagType) {
        //$htmlTagType --> Nick('h3');  Nick('p');
        //Do wypisywania nicku bedzie stosowana ta metoda
        //Tutaj wszystkie możliwe nicki będą, to jaki masz nick jest pobieranie z bazy danych ,,nickCol''
        //
        //0 - biały - domyslne
        //1 - niebieski - gdy wbijemy poziom 30
        //2 - pomaranczowy - gdy mamy ubrana legendarke
        //3 - fioletowy - ukonczenie ostatniego raida
        //4 - czerwony - 1000 punktow pvp
        //5 - ciemno czerwony - 30 poziom w trybie hardcore
        //6 - jasnozielony - 1000 razy nie poszedłeś biegac easter egg achivement

        $nickColor = 'white';
        $nickname = DatabaseManager::selectBySQL('SELECT username FROM users WHERE id='.$_SESSION['uid'])[0]['username'];
        switch(DatabaseManager::selectBySQL("SELECT nickCol FROM users WHERE id=".$_SESSION['uid'])[0]['nickCol'])
        {
            case '0': break;
            case '1': $nickColor = '#5672FA'; break;
            case '2': $nickColor = '#A57902'; break;
            case '3': $nickColor = '#214B83'; break;
            case '4': $nickColor = '#EF0C22'; break;
            case '5': $nickColor = '#751B0B'; break;
            case '6': $nickColor = '#94C98F'; break;
        }

        return "<$htmlTagType style='color: $nickColor';>$nickname</$htmlTagType>";    
    }

    public static function otherNick($id, $htmlTagType) {
       //$htmlTagType --> Nick('h3');  Nick('p');
        //Do wypisywania nicku bedzie stosowana ta metoda
        //Tutaj wszystkie możliwe nicki będą, to jaki masz nick jest pobieranie z bazy danych ,,nickCol''
        //
        //0 - biały - domyslne
        //1 - niebieski - gdy wbijemy poziom 30
        //2 - pomaranczowy - gdy mamy ubrana legendarke
        //3 - fioletowy - ukonczenie ostatniego raida
        //4 - czerwony - 1000 punktow pvp
        //5 - ciemno czerwony - 30 poziom w trybie hardcore
        //6 - jasnozielony - 1000 razy nie poszedłeś biegac easter egg achivement

        $nickColor = 'white';
        $nickname = DatabaseManager::selectBySQL('SELECT username FROM users WHERE id='.$id)[0]['username'];
        switch(DatabaseManager::selectBySQL("SELECT nickCol FROM users WHERE id=".$id)[0]['nickCol'])
        {
            case '0': break;
            case '1': $nickColor = '#5672FA'; break;
            case '2': $nickColor = '#A57902'; break;
            case '3': $nickColor = '#214B83'; break;
            case '4': $nickColor = '#EF0C22'; break;
            case '5': $nickColor = '#751B0B'; break;
            case '6': $nickColor = '#94C98F'; break;
        }

        return "<$htmlTagType style='color: $nickColor';>$nickname</$htmlTagType>";  
    }

    public static function nickById($id) {
        return DatabaseManager::selectBySQL("SELECT username FROM users WHERE id=".$id)[0]['username'];
    }

    public static function idByNick($nick) {
        return DatabaseManager::selectBySQL('SELECT id FROM users WHERE username="'.$nick.'"')[0]['id'];
    }
}