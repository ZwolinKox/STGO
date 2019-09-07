<?php
	require_once('config.php');


if(Post::exist('login') && Post::exist('pass'))
{   
    $um = new UserManager;
    
    //przekazanie do metody LogIn w klasie UserManager loginu i hasła
    if($um->LogIn(Post::get('login'), Post::get('pass')))
    {
        if(DatabaseManager::selectBySQL("SELECT serverOpen FROM admin WHERE id=1")[0]['serverOpen'] == 0)
        {
            if(DatabaseManager::selectBySQL("SELECT isAdmin FROM users WHERE id=".$_SESSION['uid'])[0]['isAdmin'] != 1)
            {
                $um = new UserManager;
                $um->LogOut();
                die ("Trwają prace techniczne!");
            }
            else
            {
                //URL::to($_SERVER['HTTP_REFERER']); //przekierowanie do gry
                URL::to('auth.php'); //Przekierowanie do gry po algorytmach autoryzacyjnych
            }
        }
        else
        {
            //URL::to($_SERVER['HTTP_REFERER']); //przekierowanie do gry
            URL::to('auth.php'); //Przekierowanie do gry po algorytmach autoryzacyjnych
        }    
    }
    else
    {    
        die ("Nieprawidłowa nazwa użytkownika lub hasło."); //nieprawidłowe dane   
    }
} 
else 
{ 
    die("DOSTĘP DO TEJ STRONY ZOSTAŁ ZABLOKOWANY!"); //wejście bez formularza  
}
?>