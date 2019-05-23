<?php
    //15% drop itemu rare (niebieski)
    //5% drop heroic (fioletowy) 

    class Drop {
        //Metoda drop zwraca id zdobytego itemu lub null jesli nie wylosowales itemu
        public static function school($enemyId) {
            $enemyData = DatabaseManager::selectBySQL('SELECT dropItemOne, dropItemTwo, dropItemThree, dropItemFour, dropItemFive FROM enemy WHERE id='.$enemyId);           
            $items = array();
            $randomSeed = rand(1, 100);
            $dropType;

            if($randomSeed <= 5)
            {
                $dropType = "heroic";
            }
            else if(($randomSeed > 5)&&($randomSeed <= 25))
            {
                $dropType = "rare";
            }
            else
            {
                return null;
            }

            if(DatabaseManager::selectBySQL('SELECT rarity FROM items WHERE id='.$enemyData[0]['dropItemOne'])[0]['dropItemOne'] == $dropType)
            {
                array_push($items, $enemyData[0]['dropItemOne']);
            }

            if(DatabaseManager::selectBySQL('SELECT rarity FROM items WHERE id='.$enemyData[0]['dropItemTwo'])[0]['dropItemTwo'] == $dropType)
            {
                array_push($items, $enemyData[0]['dropItemTwo']);
            }

            if(DatabaseManager::selectBySQL('SELECT rarity FROM items WHERE id='.$enemyData[0]['dropItemThree'])[0]['dropItemThree'] == $dropType)
            {
                array_push($items, $enemyData[0]['dropItemThree']);
            }

            if(DatabaseManager::selectBySQL('SELECT rarity FROM items WHERE id='.$enemyData[0]['dropItemFour'])[0]['dropItemFour'] == $dropType)
            {
                array_push($items, $enemyData[0]['dropItemFour']);
            }

            if(DatabaseManager::selectBySQL('SELECT rarity FROM items WHERE id='.$enemyData[0]['dropItemFive'])[0]['dropItemFive'] == $dropType)
            {
                array_push($items, $enemyData[0]['dropItemFive']);
            }

            $dropSeed = rand(0, count($items)-1);

            return $items[$dropSeed];
        }
    }

    class Item {
        private $itemId;
        private $itemDropChance;

        function __construct($inputItem) {
            $itemId = $inputItem;
            $itemDropChance = DatabaseManager::selectBySQL('SELECT "dropChance" FROM items WHERE id='.$inputItem)[0]['dropChance'];
        }

        public function getId(){
            return $itemId;
        }

        public function getDrop(){
            return $itemDropChance;
        }
       
    }
?>