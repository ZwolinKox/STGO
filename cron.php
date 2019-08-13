<?php
require_once('config.php');

//Tu dodajemy metody, które mają wykonywać się codziennie

//Codzienne kopanie słysznCoinów
Miner::mineCoins();

//Resetowanie cooldown'u na nagrode w riftach 
Rift::setBool();

//Wykonanie kopii zapasowej tabeli users
Admin::backupNow();
?>