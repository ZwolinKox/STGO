<?php
ob_start();
session_start();

// OKREŚLENIE POŁOŻENIA STRONY W SERWISIE
$AbsoluteURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
$dirCat = dirname($_SERVER['PHP_SELF']);
$AbsoluteURL .= $_SERVER['HTTP_HOST'];
$AbsoluteURL .= $dirCat != '\\' ? $dirCat : "";
$slash = substr($AbsoluteURL, -1);
$NewURL = $slash != '/' ? $AbsoluteURL.'/' : $AbsoluteURL;
// STAŁE DLA BAZY DANYCH
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PW', '');
define('DB_DB', 'stgo');
// STAŁA DLA ADRESU I LOKALIZACJI APLIKACJI
define('SERVER_ADDRESS', $NewURL);

set_include_path(get_include_path(). PATH_SEPARATOR . "./CLASS");
set_include_path(get_include_path(). PATH_SEPARATOR . "./CLASS/Managers");
set_include_path(get_include_path(). PATH_SEPARATOR . "./LIBRARY");
set_include_path(get_include_path(). PATH_SEPARATOR . "./VIEWS");
set_include_path(get_include_path(). PATH_SEPARATOR . "./VIEWS/Templates");
set_include_path(get_include_path(). PATH_SEPARATOR . "./PUBLIC");
set_include_path(get_include_path(). PATH_SEPARATOR . "./PUBLIC/JS");
set_include_path(get_include_path(). PATH_SEPARATOR . "./PUBLIC/CSS");
set_include_path(get_include_path(). PATH_SEPARATOR . "./PUBLIC/IMG");


// Funkcja automatycznie ładująca klasy wg. zapotrzebowania
function __autoload($className) {
    
    include_once($className.".class.php");
    
}

if(isset($_SESSION['logged']) && $_SESSION['logged']) {
    if(is_array(DatabaseManager::selectBySQL('SELECT banCheck FROM users WHERE banCheck > now() AND id='.$_SESSION['uid'])[0])) 
    {
        $unban = DatabaseManager::selectBySQL('SELECT banCheck FROM users WHERE id='.$_SESSION['uid'])[0]['banCheck'];
        
        $banInfo = "";
        if(DatabaseManager::selectBySQL('SELECT banInfo FROM users WHERE id='.$_SESSION['uid'])[0]['banInfo'] != "")
        {
            $banInfo = DatabaseManager::selectBySQL('SELECT banInfo FROM users WHERE id='.$_SESSION['uid'])[0]['banInfo'];
        }
        
        echo <<< END
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8" />
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <title>Słysz Symulator Template</title>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
                <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
                <script src="main.js"></script>
            
            
                <style>
                    .btn-dark {
                        margin-top: 15px;
                    }
                    
                    .btn-dark:hover {
                        cursor: pointer;
                    }
                </style>
                
            </head>
            <body style="background-color: rgb(95, 95, 95); color: white;">
            
            
                <div class="container-fluid ">
                    <div class="row">
                        <div style="background-color: rgb(37, 37, 44);" class="col-12">
                            <div class="display-4 d-none d-md-block">Słysz Symulator Online</div>
                            <div class="display-4 d-md-none">SSO</div>
                        </div>
                    </div>
                </div>
            
                <div class="container-fluid d-flex justify-content-center" style="background-color: rgb(50, 50, 58);">
                    <div class="row d-flex">
                        <?php require_once 'navbar.php' ?>
                    </div>
                </div>
            
                <div class="container"> <!-- ŚRODEK !-->
                    <div class="row">
                                            
                            <div class="col-12 text-center display-4">Jesteś martwy do $unban</div>
                            <div class="col-12 text-center display-4"><p style="color: red">$banInfo</p></div>
                            
                            <div class="col-12" style="margin-top: 15px;">
            
                                <!-- TU SIĘ ZACZYNAJĄ ŚWIRKI -->
                                <div class="text-center btn-dark btn-lg href" id="index.php">Powrót</div>


                            </div>
                            
                    </div>
                </div> <!-- ŚRODEK -->
            
                <br/><br/>
                
                <footer style="background-color: rgb(37, 37, 44); padding-top: -10px;" class="footer fixed-bottom text-center">
                    Słysz Symulator 2018 &copy; Wszelkie prawa zastrzeżone
                </footer>
                
            
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
            </body>
            </html>`
END;

    
    $um = new UserManager;

    $um->LogOut();

    die();

    }
    /*elseif () {
        
    }*/
    
}






