<?php

class Legendary {
    private function __construct() {

    }

    public static function description() {
        $weaponId = DatabaseManager::selectBySQL("SELECT eqMainHand FROM users WHERE id=".$_SESSION['uid'])[0]['eqMainHand'];

        $passive = DatabaseManager::selectBySQL("SELECT * FROM legendarypassives WHERE itemId=$weaponId")[0];

        if($passive['id'] <= 0)
            return;

        $description = '
        <br>
        <a class="btn btn-warning" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        Opis przedmiotu
        </a>
        
        <div class="collapse" id="collapseExample">
        <div class="card bg-dark card-body">
            <h3>Działanie:</h3>
            <div class="card-header">'.$passive['name'].'</div>
            <div class="card-body">
            '.$passive['description'].'

            <h3>Historia:</h3>

            '.$passive['itemDescription'].'

            </div>
        </div>
        </div>
        ';

        return $description;
       
    }


    public static function legendaryPassive()
    {
        $weaponId = DatabaseManager::selectBySQL("SELECT eqMainHand FROM users WHERE id=".$_SESSION['uid'])[0]['eqMainHand'];

        $passive = DatabaseManager::selectBySQL("SELECT * FROM legendarypassives WHERE itemId=$weaponId")[0];

        if($passive['id'] <= 0)
            return ' xd ';


        $fightId = DatabaseManager::selectBySQL('SELECT id FROM fight WHERE status=0 AND playerOne='.$_SESSION['uid'].' OR playerTwo='.$_SESSION['uid'])[0]['id'];
        $enemyId = DatabaseManager::selectBySQL('SELECT playerOne, playerTwo FROM fight WHERE playerOne='.$_SESSION['uid'].' OR playerTwo='.$_SESSION['uid'])[0];



        if($enemyId['playerOne'] == $_SESSION['uid']) 
            $enemyId = $enemyId['playerTwo'];
        else
            $enemyId = $enemyId['playerOne'];
        


        switch ($passive['id']) {
            case '1':
                {
                    if(rand(1, 100) <= $passive['chance'])
                    {
                        $maxHp = DatabaseManager::selectBySQL('SELECT maxHp FROM users WHERE id='.$enemyId)[0]['maxHp'];

                        $dmg = $maxHp/10;

                        DatabaseManager::updateTable('users', ['statHpPvp' => 'statHpPvp-'.$dmg], ['id' => $enemyId]);

                        return " + <h5 style='color: red;'>".$passive['name']."</h5>";
                    }
                    break;
                }

                case '2':
                {
                    if(rand(1, 100) <= $passive['chance'])
                    {
                        $maxHp = DatabaseManager::selectBySQL('SELECT maxHp FROM users WHERE id='.$_SESSION['uid'])[0]['maxHp'];

                        $heal = ($maxHp / 100) * 6;

                        DatabaseManager::updateTable('users', ['statHpPvp' => 'statHpPvp+'.$heal], ['id' => $_SESSION['uid']]);

                        return " + <h5 style='color: red;'>".$passive['name']."</h5>";
                    }
                    break;
                }
            
            default:
                # code...
                break;
        }
        
        return ' ';

    }
}