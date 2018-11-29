<?php
ob_start();
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

// Funkcja automatycznie ładująca klasy wg. zapotrzebowania
function __autoload($className) {
    
    include_once($className.".class.php");
    
}