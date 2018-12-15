<?php
                    $stats = DatabaseManager::selectBySQL('SELECT * FROM users WHERE id='.$_SESSION['uid'])[0];
    
                    echo '<p>Dzień tygodnia: '.$stats['dayWeek'].'</p>';
                    echo '<p>Dzień w grze: '.$stats['dayGame'].'</p>';
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