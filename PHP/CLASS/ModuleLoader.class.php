<?php

//Do dopracowania. Ładuje moduły/widoki wg ich nazwy
class ModuleLoader {
    
    static public function load($MODULE) {

        require_once($MODULE.'.view.php');
        
    }
    
}
