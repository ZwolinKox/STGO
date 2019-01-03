<?php
                    $stats = DatabaseManager::selectBySQL('SELECT * FROM users WHERE id='.$_SESSION['uid'])[0];


                    switch ($stats['dayWeek']) {
                        case '1':
                            $stats['dayWeek'] = 'poniedziałek';
                            break;
                            case '2':
                            $stats['dayWeek'] = 'wtorek';
                            break;
                            case '3':
                            $stats['dayWeek'] = 'środa';
                            break;
                            case '4':
                            $stats['dayWeek'] = 'czwartek';
                            break;
                            case '5':
                            $stats['dayWeek'] = 'piątek';
                            break;
                            case '6':
                            $stats['dayWeek'] = 'sobota';
                            break;
                            case '7':
                            $stats['dayWeek'] = 'niedziela';
                            break;
                    }
    
                    echo '<h3 style="color: pink"><p>Witaj '.$stats['username'].'!</p></h3>';    //Nie wiem gdzie ta zmienna bedziemy trzymac, musi to byc wspólne 
                    echo '<p>Dzień tygodnia: '.$stats['dayWeek'].'</p>';    //Nie wiem gdzie ta zmienna bedziemy trzymac, musi to byc wspólne 
                    echo '<p>Dzień w grze: '.$stats['dayGame'].'</p>';  //To musze dodac to tabeli user bo nie ma xD
                    echo '<p>Słysz Coiny: '.$stats['slyszCoin'].'</p>';
                    echo '<p>XP: '.$stats['xpPoints'].'/'.$stats['maxXp'].'</p>';
                    echo '<p>lvl: '.$stats['userLevel'].'</p>';
                    echo '<p>SłyszLeaguePoints: '.$stats['userLeaguePoints'].'</p>';
                    echo '<p>Energia: '.$stats['userEnergy'].'</p>';
                    echo '<p>Intelekt: '.$stats['statIntelect'].'</p>';
                    echo '<p>AD: '.$stats['statDamage'].'</p>';
                    echo '<p>Zręczność: '.$stats['statDex'].'</p>';
                    echo '<p>HP: '.$stats['statHp'].'/'.$stats['maxHp'].'</p>';
                    echo '<p>Krytyk: '.$stats['statCritChance'].'%'.'</p>';
                    echo '<p>Armor: '.$stats['statArmor'].'</p>';
                    echo '<p>Obecnie posiadana broń <span style="color: gold;">*LEGENDARNE*</span>'.$stats['eqMainHand'].'</p>';


                    //To trzeba będzie też lepiej poukładać, ale to potem XDD