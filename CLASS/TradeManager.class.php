<?php

//Klasa ułatwiająca handel
class TradeManager {
    static public function buyById($id) {
        if(DatabaseManager::selectbySQL("SELECT slyszCoin FROM users WHERE id=".$_SESSION['uid'])[0]['slyszCoin'] > DatabaseManager::selectBySQL("SELECT vendorCost FROM items WHERE id=$id")[0]['vendorCost'])
        {
            $cost = DatabaseManager::selectBySQL("SELECT vendorCost FROM items WHERE id=$id")[0]['vendorCost'];
            DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-'.$cost], ['id' => $_SESSION['uid']]);
            unset($cost);

            if(DatabaseManager::selectBySQL("SELECT eqMainHand FROM users WHERE id=".$_SESSION['uid'])[0]['eqMainHand'] == 0)
            {
                DatabaseManager::updateTable('users', ['eqMainHand' => $id], ['id' => $_SESSION['uid']]);
            }
            else if(DatabaseManager::selectBySQL("SELECT eqSlotOne FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotOne'] == 0)
            {
                DatabaseManager::updateTable('users', ['eqSlotOne' => $id], ['id' => $_SESSION['uid']]);
            }
            else if(DatabaseManager::selectBySQL("SELECT eqSlotTwo FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotTwo'] == 0)
            {
                DatabaseManager::updateTable('users', ['eqSlotTwo' => $id], ['id' => $_SESSION['uid']]);
            }
            else if(DatabaseManager::selectBySQL("SELECT eqSlotThree FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotThree'] == 0)
            {
                DatabaseManager::updateTable('users', ['eqSlotThree' => $id], ['id' => $_SESSION['uid']]);
            }
            else if(DatabaseManager::selectBySQL("SELECT eqSlotFour FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotFour'] == 0)
            {
                DatabaseManager::updateTable('users', ['eqSlotFour' => $id], ['id' => $_SESSION['uid']]);
            }
            else if(DatabaseManager::selectBySQL("SELECT eqSlotFive FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotFive'] == 0)
            {
                DatabaseManager::updateTable('users', ['eqSlotFive' => $id], ['id' => $_SESSION['uid']]);
            }
            else if(DatabaseManager::selectBySQL("SELECT eqSlotSix FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotSix'] == 0)
            {
                DatabaseManager::updateTable('users', ['eqSlotSix' => $id], ['id' => $_SESSION['uid']]);
            }
            else if(DatabaseManager::selectBySQL("SELECT eqSlotSeven FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotSeven'] == 0)
            {
                DatabaseManager::updateTable('users', ['eqSlotSeven' => $id], ['id' => $_SESSION['uid']]);
            }
            else if(DatabaseManager::selectBySQL("SELECT eqSlotEight FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotEight'] == 0)
            {
                DatabaseManager::updateTable('users', ['eqSlotEight' => $id], ['id' => $_SESSION['uid']]);
            }
            else
            {
                echo '<h3 style="color: red;">Nie masz miejsca w ekwipunku!</h3>';
            }
        }
        else
        {
            echo '<h3 style="color: red;">Nie masz wystarczająco Słysz Coinów!</h3>';
        }
    }

}