<?php

define('DB_SERVER', );
define('DB_USERNAME', );
define('DB_PW', );
define('DB_DB', );

//Klasyczny model. Połączenie z bazą danych
class DatabaseManager {
    static public function getConnection() {
        $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PW, DB_DB); //Tworzymy połączenie przekazując zmienne utworzone w pliku config.php
        if(mysqli_connect_errno())  //W przypadku błędu z połączeniem
            return false;
        else
            return $conn; //Zwracamy połączenie
    }
    //Funkcja pozwalająca wykonać zapytanie sql 'SELECT'
    static public function selectBySQL($SQL) {
        
        $conn = self::getConnection(); //Łączymy się z bazą danych 
        $result = $conn->query($SQL); //Wykonujemy zapytanie
        if(!$result) //Jeżeli zapytanie się nie powiodło zwraca false
            return false;
        $resultArray = Array(); //Tworzymy tablicę
        while(($row = $result->fetch_array(MYSQLI_ASSOC)) !== NULL) { //Dodajemy wyniki zapytania do tablicy
            $resultArray[] = $row;
        }
        if(count($resultArray) > 0) { 
            return $resultArray; //Jeśli tablica zawiera wyniki, czyli odnaleziono dane w bazie danych to zwracamy tą tablicę z wynikami
        } else {
            return false; //Zwracamy false
        }
    
        mysqli_close($conn); //zamknięcie połączenia
    }
    static public function updateTable($TABLE, $SET, $WHERE = Array(), $OPER = "AND") { // wzór zapytania: "UPDATE tabela SET kolumna='wartosc' WHERE kolumna='wartosc'"
        $conn = self::getConnection();
        $SQL = "UPDATE {$TABLE} SET "; //Początek zapytania
        foreach($SET as $key => $val) { //Pętla przechodząca po tablicy $SET
            $SQL .= $key."='".$val."',"; //dodawanie do zapytania wartości do ustawienia
        }
        $SQL = rtrim($SQL, ','); //obcięcie ostatniego przecinka z zapytania
        if(count($WHERE) > 0) { //Jeżeli tablica $WHERE ma zawartość
           
            $SQL .= " WHERE "; //Jeżeli ma dodajemy zapytanie WHERE
            foreach($WHERE as $key => $val) { //analogicznie jak przy $SET
                $SQL .= $key."='".$val."' ".$OPER." "; //uzupełniamy zapytanie o warunki oddzielone operatorem (domyślnie AND)
            }
            $SQL = substr($SQL, 0, strlen($SQL)-(strlen($OPER)+2)); //obcięcie końcowego operatora
        }
        $result = $conn->query($SQL);
        if($result)
            return true;
        return false;
        mysqli_close($conn);
    }
    static public function deleteFrom($TABLE, $WHERE = [], $OPER = "AND") { // wzór zapytania "DELETE FROM tabela WHERE kolumna='wartosc'"
        $conn = self::getConnection(); //Połączenie
        $SQL = "DELETE FROM {$TABLE}"; //Początek zapytania
        if(count($WHERE) > 0 ) { //Jeżeli tablica WHERE ma jakąś zawartość
            $SQL .= " WHERE "; //Dodajemy do zapytania where
            foreach($WHERE as $key => $val) {
                $SQL .= $key."='".$val."' ".$OPER." ";
            }
            $SQL = substr($SQL, 0, strlen($SQL) - (strlen($OPER)+2)); //usuwamy końcowy operator
        }
        $result = $conn->query($SQL);
        
        if(!($result))
            return false;
        return true;
        $mysqli_close($conn);
    }
    static public function insertInto($TABLE, $DATA) { //wzór zapytania "INSERT INTO table_name (column1, ...) VALUES (value1, ...)"
        $conn = self::getConnection(); //połączenie z bazą
        
        $SQL = "INSERT INTO {$TABLE}"; //początek zapytania
        $SQL .= " (";
        
        foreach($DATA as $key => $val) {
            $SQL .= $key.","; //dodanie do zapytania wybranych kolumn
        }
        
        $SQL = rtrim($SQL, ","); //obcięcie przecinka z końca zapytania
        $SQL .= ") ";
        $SQL .= "VALUES";
        $SQL .= " (";
        
        foreach($DATA as $val) {
            $SQL .= "'".$val."',"; //dodanie do zapytania wybranych wartości
        }
        
        $SQL = rtrim($SQL, ','); //obcięcie przecinka z końca zapytania
        $SQL .= ")";
        
        $result = $conn->query($SQL); //wystasowanie zapytania
        if(!($result)) {
            return false; //niepowodzenie, zwracamy false
        } else {
            return true; //powodzenie, zwracamu true
        }
        
        mysqli_close($conn); //zamknięcie połączenie
    }
}