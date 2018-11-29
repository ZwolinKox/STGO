<?php
if((strlen(Post::get('username')) >= 5 && strlen(Post::get('username')) <= 20) &&
   (strlen(Post::get('username')) >= 5 && strlen(Post::get('username')) <= 25) &&
    (preg_match('/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i', $_POST['email']))) {
    
    $um = new UserManager;
    
    $res = $um->CreateUser($_POST); //przesłanie tablicy do metody CreateUser w klasie UserManager
    
    if($res) {
         $um->LogIn(Post::get('username'), Post::get('username')); //zarejestrowano, logujemy użytkownika
    } else {
        
        die("Utworzenie użytkownika nie było możliwe!"); //przekierowanie na stronę błędu
        
    }
    
} else {
    die("DOSTĘP DO TEJ STRONY ZOSTAŁ ZABLOKOWANY!"); //wejście poza formularzem
}