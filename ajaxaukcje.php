<?php

require_once 'config.php';

if(Post::exist('itemId'))
{  

    $auctionData = DatabaseManager::selectBySQL('SELECT * FROM auctions WHERE id='.Post::get('itemId'));

    if(!$auctionData[0]['isSold'])
    {
        if(Action::getCoins() >= $auctionData[0]['itemPrice'])
        {
            if($_SESSION['uid'] != $auctionData[0]['sellerId'])
                $eqSpace = EqManager::findSpace();

                if($eqSpace != null)
                {
                    Action::delCoin($auctionData[0]['itemPrice']); //Odjęcie waluty kupującemu
                    DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin+'.$auctionData[0]['itemPrice']], ['id' => $auctionData[0]['sellerId']]); //Dodanie waluty sprzedającemu
                    DatabaseManager::updateTable('users', [$eqSpace => $auctionData[0]['itemId']], ['id' => $_SESSION['uid']]); //Dodanie itemu do ekwipunku kupującego
                    DatabaseManager::updateTable('auctions', ['isSold' => 1], ['id' => Post::get('itemId')]); //Otagowanie przedmiotu w bazie danych jako sprzedany
                }
        }
    }
    
}

?>