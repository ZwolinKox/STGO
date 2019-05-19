<?php

require_once "config.php";


if(Post::exist('itemCost'))
{
    if(Post::exist('itemId'))
    {   
        //Action::delCoin(1);
        $item = Post::get('itemId');
        
        if(EqManager::findItem($item) != null)
        {
            DatabaseManager::insertInto("auctions", ["itemId" => $item, "sellerId" => $_SESSION['uid'], "itemPrice" => Post::get('itemCost'), "isSold" => 0]);
            DatabaseManager::updateTable('users', [EqManager::findItem($item) => 0], ['id' => $_SESSION['uid']]);
            Action::delCoin(20);
        }
    }
}
?>