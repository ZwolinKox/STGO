<?php
    //10% drop itemu rare (niebieski)
    //1% drop heroic (fioletowy) 

    class Drop {
        //Metoda drop zwraca id zdobytego itemu lub null jesli nie wylosowales itemu
        public static function school($enemyId) {
            $itemFirst = DatabaseManager::selectBySQL('SELECT dropItemOne FROM enemy WHERE id='.$enemyId)[0]['dropItemOne'];
            $itemTwo = DatabaseManager::selectBySQL('SELECT dropItemTwo FROM enemy WHERE id='.$enemyId)[0]['dropItemTwo'];
            $itemThree = DatabaseManager::selectBySQL('SELECT dropItemThree FROM enemy WHERE id='.$enemyId)[0]['dropItemThree'];
            $itemFour = DatabaseManager::selectBySQL('SELECT dropItemFour FROM enemy WHERE id='.$enemyId)[0]['dropItemFour'];
            $itemFive = DatabaseManager::selectBySQL('SELECT dropItemFive FROM enemy WHERE id='.$enemyId)[0]['dropItemFive'];           
            
            $items = array();
            $randomSeed = rand(1, 100);
            $dropType;

            //DROPIENIE CZESCI DO KOPARKI
            if(rand(1, 100) <= 25)
            {
                switch(rand(1, 4))
                {
                    case 1: DatabaseManager::updateTable('users', ['collectElik' => 'collectElik+1'], ['id' => $_SESSION['uid']]); break;
                    case 2: DatabaseManager::updateTable('users', ['collectElyk' => 'collectElyk+1'], ['id' => $_SESSION['uid']]); break;
                    case 3: DatabaseManager::updateTable('users', ['collectInfo' => 'collectInfo+1'], ['id' => $_SESSION['uid']]); break;
                    case 4: DatabaseManager::updateTable('users', ['collectEnod' => 'collectEnod+1'], ['id' => $_SESSION['uid']]); break;       
                }
            }



            //DROPIENIE ITEMA
            if($randomSeed <= 1)
            {
                $dropType = "heroic";
            }
            else if(($randomSeed > 20)&&($randomSeed <= 30))
            {
                $dropType = "rare";
            }
            else
            {
                return null;
            }


            if(DatabaseManager::selectBySQL('SELECT rarity FROM items WHERE id='.$itemFirst)[0]['rarity'] == $dropType)
            {
                array_push($items, $itemFirst);
            }

            if(DatabaseManager::selectBySQL('SELECT rarity FROM items WHERE id='.$itemTwo)[0]['rarity'] == $dropType)
            {
                array_push($items, $itemTwo);
            }

            if(DatabaseManager::selectBySQL('SELECT rarity FROM items WHERE id='.$itemThree)[0]['rarity'] == $dropType)
            {
                array_push($items, $itemThree);
            }

            if(DatabaseManager::selectBySQL('SELECT rarity FROM items WHERE id='.$itemFour)[0]['rarity'] == $dropType)
            {
                array_push($items, $itemFour);
            }

            if(DatabaseManager::selectBySQL('SELECT rarity FROM items WHERE id='.$itemFive)[0]['rarity'] == $dropType)
            {
                array_push($items, $itemFive);
            }

            $dropSeed = rand(0, count($items)-1);

            return $items[$dropSeed];
        }

        static public function raid($enemyId) {
            $itemFirst = DatabaseManager::selectBySQL('SELECT dropItemOne FROM enemy WHERE id='.$enemyId)[0]['dropItemOne'];
            $itemTwo = DatabaseManager::selectBySQL('SELECT dropItemTwo FROM enemy WHERE id='.$enemyId)[0]['dropItemTwo'];
            $itemThree = DatabaseManager::selectBySQL('SELECT dropItemThree FROM enemy WHERE id='.$enemyId)[0]['dropItemThree'];
            $itemFour = DatabaseManager::selectBySQL('SELECT dropItemFour FROM enemy WHERE id='.$enemyId)[0]['dropItemFour'];
            $itemFive = DatabaseManager::selectBySQL('SELECT dropItemFive FROM enemy WHERE id='.$enemyId)[0]['dropItemFive'];           
            
            $items = array();
            $randomSeed = rand(1, 1000);
            $dropType;

            //DROPIENIE ITEMA
            if($randomSeed <= 1)
            {
                $dropType = "legendary";
            }
            else if(($randomSeed > 200)&&($randomSeed <= 300))
            {
                $dropType = "heroic";
            }
            else
            {
                return null;
            }


            if(DatabaseManager::selectBySQL('SELECT rarity FROM items WHERE id='.$itemFirst)[0]['rarity'] == $dropType)
            {
                array_push($items, $itemFirst);
            }

            if(DatabaseManager::selectBySQL('SELECT rarity FROM items WHERE id='.$itemTwo)[0]['rarity'] == $dropType)
            {
                array_push($items, $itemTwo);
            }

            if(DatabaseManager::selectBySQL('SELECT rarity FROM items WHERE id='.$itemThree)[0]['rarity'] == $dropType)
            {
                array_push($items, $itemThree);
            }

            if(DatabaseManager::selectBySQL('SELECT rarity FROM items WHERE id='.$itemFour)[0]['rarity'] == $dropType)
            {
                array_push($items, $itemFour);
            }

            if(DatabaseManager::selectBySQL('SELECT rarity FROM items WHERE id='.$itemFive)[0]['rarity'] == $dropType)
            {
                array_push($items, $itemFive);
            }

            $dropSeed = rand(0, count($items)-1);

            return $items[$dropSeed];
        }

        static public function levelUp($currentLevel) { 
            //LEVELCAP
            define('LEVELCAP', 30);

            if($currentLevel < LEVELCAP)
            {
                DatabaseManager::updateTable('users', ['xpPoints' => "0", 'userLevel' => 'userLevel+1'], ['id' => $_SESSION['uid']]);
                $maxXp = DatabaseManager::selectBySQL('SELECT maxXp FROM users WHERE id='.$_SESSION['uid'])[0]['maxXp'];

                $newMaxXp;
                if($currentLevel < 10)
                {
                    $newMaxXp = $maxXp + 80;
                }
                else if(($currentLevel >= 10)&&($currentLevel < 20))
                {
                    $newMaxXp = $maxXp + ($maxXp / 4);
                }
                else if(($currentLevel >=  20)&&($currentLevel < 30))
                {
                    $newMaxXp = intval($maxXp + ($maxXp / 5));
                }

                DatabaseManager::updateTable('users', ['maxXp' => $newMaxXp], ['id' => $_SESSION['uid']]);
            }
            else
            {
                DatabaseManager::updateTable('users', ['xpPoints' => "0", 'userLevel' => 'userLevel+1'], ['id' => $_SESSION['uid']]);
                $maxXp = DatabaseManager::selectBySQL('SELECT maxXp FROM users WHERE id='.$_SESSION['uid'])[0]['maxXp'];
            
                DatabaseManager::updateTable('users', ['xpPoints' => $maxXp, 'userLevel' => LEVELCAP], ['id' => $_SESSION['uid']]);
            }

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