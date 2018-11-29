<?php
	require_once('config.php');


if(Post::exist('login') && Post::exist('pass')) {
        
    $um = new UserManager;
    
    if($um->LogIn(Post::get('login'), Post::get('pass'))) { //przekazanie do metody LogIn w klasie UserManager loginu i hasła
        
        URL::to($_SERVER['HTTP_REFERER']); //przekierowanie do gry
        
    } else {
        
        die ("Nieprawidłowa nazwa użytkownika lub hasło."); //nieprawidłowe dane
        
    }
    
} else { 
    die("DOSTĘP DO TEJ STRONY ZOSTAŁ ZABLOKOWANY!"); //wejście bez formularza  
}
?>