<?php

//Klasa która pomoże nam zarządzać ewkipunkiem
class EqManager {
    //Szukanie pierwszego wolnego miejsca w ekwipunku
    //W przyszłości tą metode zastosujemy w klasie TradeManager w metodzie BuyById, narazie niech służy tylko do zarządzanie eq
    public static function findSpace() {
        if(DatabaseManager::selectBySQL("SELECT eqSlotOne FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotOne'] == 0)
        {
            return 'eqSlotOne';
        }
        else if(DatabaseManager::selectBySQL("SELECT eqSlotTwo FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotTwo'] == 0)
        {
            return 'eqSlotTwo';
        }
        else if(DatabaseManager::selectBySQL("SELECT eqSlotThree FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotThree'] == 0)
        {
            return 'eqSlotThree';
        }
        else if(DatabaseManager::selectBySQL("SELECT eqSlotFour FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotFour'] == 0)
        {
            return 'eqSlotFour';
        }
        else if(DatabaseManager::selectBySQL("SELECT eqSlotFive FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotFive'] == 0)
        {
            return 'eqSlotFive';
        }
        else if(DatabaseManager::selectBySQL("SELECT eqSlotSix FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotSix'] == 0)
        {
            return 'eqSlotSix';
        }     
        else if(DatabaseManager::selectBySQL("SELECT eqSlotSeven FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotSeven'] == 0)
        {
            return 'eqSlotSeven';
        }
        else if(DatabaseManager::selectBySQL("SELECT eqSlotEight FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotEight'] == 0)
        {
            return 'eqSlotEight';
        }

        return null;
    }

    //Sprawdzanie czy możemy używać daną broń
    //Ta metoda będzie wywoływana za każym razem jak będziemy ubierać broń, jeśli zwróci true to warunek będzie spełnmiony i zsotanie ubrana, jeśli nie to nie
    public static function checkHand($itemid) {
        if(DatabaseManager::selectBySQL("SELECT forLevel FROM items WHERE id=".$itemid)[0]['forLevel'] > DatabaseManager::selectBySQL("SELECT userLevel FROM users WHERE id=".$_SESSION['uid'])[0]['userLevel'])
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    //Musze na spokojnie przeanalizować czy to ma sens ale chyba tak
    //Zakładanie danego przedmiotu
    public static function putOn($slot) {
        if(checkHand(DatabaseManager::selectBySQL("SELECT '.$slot.' FROM users WHERE id=".$_SESSION['uid'])[0][$slot]))
        {
            $bufferOld = DatabaseManager::selectBySQL("SELECT eqMainHand FROM users WHERE id=".$_SESSION['uid'])[0]['eqMainHand'];
            $bufferNew = DatabaseManager::selectBySQL("SELECT '.$slot.' FROM users WHERE id=".$_SESSION['uid'])[0][$slot];

            DatabaseManager::updateTable('users', ['eqMainHand' => $bufferNew, $slot => $bufferOld], ['id' => $_SESSION['uid']]);

            unset($bufferNew, $bufferOld);
        }
    }

    //$id podajemy id temu
    //$writeType (typ wypisania) name = nazwa, color = kolor, colorTag = tagi span z parametrem koloru
    public static function item($id, $writeType) {
        $dataRarity = DatabaseManager::selectbySQL('SELECT rarity FROM items WHERE id='.$id)[0]['rarity'];
        $dataName = DatabaseManager::selectbySQL('SELECT name FROM items WHERE id='.$id)[0]['name'];

        if($writeType == 'name')
        {
            return $dataName;
        }
        else
        {
            $color = '#34FD6D';
            switch($dataRarity)
            {
                case 'common': break;
                case 'rare': $color = '#076DD8'; break;
                case 'heroic': $color = '#623CD0'; break;
                case 'legendary': $color = '#D0B95B'; break;
            }

            if($writeType == 'color')
            {
                return $color;
            }
            else if($writeType == 'colorTag')
            {
                //return '<span style="color: '.$color.';>'.$dataName.'</span>';
                return "<span style='color: $color;>$dataName</span>";
            }
            else
            {
                //BŁAD - ZŁY PARAMETR METODY
            }
       }
    }
}

?>