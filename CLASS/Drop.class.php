<?php
    //20% drop itemu rare (niebieski)
    //5% drop heroic (fioletowy) 
    
    class Drop {
        public static function item($enemyId) {
            $enemyData = DatabaseManager::selectBySQL('SELECT "dropItemOne", "dropItemTwo", "dropItemThree", "dropItemFour", "dropItemFive" FROM enemy WHERE id='.$enemyId);           
            $items = array();




            
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