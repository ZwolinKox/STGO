<?php

require_once "config.php";


if(Post::exist('itemCost'))
{
    if(Post::exist('itemId'))
    {   
        $item = Post::get('itemId');
        
        if(EqManager::findItem($item) != null)
        {
            DatabaseManager::insertInto("auctions", ["itemId" => $item, "sellerId" => $_SESSION['uid'], "itemPrice" => abs(Post::get('itemCost')), "isSold" => 0]);
            DatabaseManager::updateTable('users', [EqManager::findItem($item) => 0], ['id' => $_SESSION['uid']]);
            Action::delCoin(20);
        }
    }
}
?>