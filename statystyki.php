
<?php 
    require_once 'config.php';

    $stats = DatabaseManager::selectBySQL('SELECT * FROM users WHERE id='.$_SESSION['uid'])[0];
    $stats['pass'] = 'xxx';

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

        
        switch ($stats['team']) {
            case '1':
                $stats['team'] = 'LKS 1908 Nędza';
                $stats['colorTeam'] = '#ffcd2b';
                break;
                case '2':
                $stats['team'] = 'LKS Zgoda Zawada Książęca';
                $stats['colorTeam'] = '#ff1616';
                break;
                case '3':
                $stats['team'] = 'KS Unia Racibórz';
                $stats['colorTeam'] = '#42c5f4';
        }
        
        echo '<div id="stats">';
        echo '<h3 style="color: pink" id="username"><p>Witaj '.$stats['username'].'!</p></h3>';
        echo '<p id="dayweek">Dzień tygodnia: '.$stats['dayWeek'].'</p>';    //Nie wiem gdzie ta zmienna bedziemy trzymac, musi to byc wspólne 
        echo '<p id="daygame">Dzień w grze: '.$stats['dayGame'].'</p>';  //To musze dodac to tabeli user bo nie ma xD
        echo '<p id="slyszCoin">Słysz Coiny: '.$stats['slyszCoin'].'</p>';
        echo '<p>XP: <span id="xppoints">'.$stats['xpPoints'].'</span>/<span id="maxxp">'.$stats['maxXp'].'</span></p>';
        echo '
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="'.$stats['xpPoints'].'" aria-valuemin="0" aria-valuemax="'.$stats['maxXp'].'" style="width:'.$stats['xpPoints'].'%">
            '.$stats['xpPoints'].'%</div>
        </div>
        ';
        echo '<p id="userlevel">lvl: '.$stats['userLevel'].'</p>';
        echo '<p id="userleaguepoints">SłyszLeaguePoints: '.$stats['userLeaguePoints'].'</p>';
        echo '<p id="userenergy">Energia: '.$stats['userEnergy'].'</p>';
        echo '<p id="statintelect">Intelekt: '.$stats['statIntelect'].'</p>';
        echo '<p id="statdamage">AD: '.$stats['statDamage'].'</p>';
        echo '<p id="statdex">Zręczność: '.$stats['statDex'].'</p>';
        echo '<p>HP: <span id="stathp">'.$stats['statHp'].'</span>/<span id="maxhp">'.$stats['maxHp'].'</span></p>';
        echo '<p id="team">Twoja drużyna: <span style="color: '.$stats['colorTeam'].'">'.$stats['team'].'</span></p>';
        echo '<p id="statarmor">Armor: '.$stats['statArmor'].'</p>';
        echo '<p id="eqmainhand">Obecnie posiadana broń: '.$stats['eqMainHand'].'</p>';
        echo '</div>'
?>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous" defer></script>
        <script defer>

        setInterval(() => {
            $.ajax({
            url : "ajaxstats.php",
            method : "POST",
            data : {
                ajax : "ajax"
            },
        })
        .done((result) => {

            const resultObj = JSON.parse(result);

            console.log(resultObj);
            
            document.querySelector('#stats').innerHTML  = `
                <h3 style="color: pink" id="username"><p>Witaj ${ resultObj.username }!</p></h3>
                <p id="dayweek">Dzień tygodnia: ${ resultObj.dayWeek }</p>
                <p id="daygame">Dzień w grze: ${ resultObj.dayGame }</p>
                <p id="slyszCoin">Słysz Coiny: ${ resultObj.slyszCoin }</p>

                <p>XP: <span id="xppoints">${ resultObj.xpPoints }</span>/<span id="maxxp">${ resultObj.maxXp }</span></p>
                <p id="userlevel">lvl: ${ resultObj.userLevel }</p>
                <p id="userleaguepoints">SłyszLeaguePoints: ${ resultObj.userLeaguePoints}</p>
                <p id="userenergy">Energia: ${ resultObj.userEnergy}</p>
                <p id="statintelect">Intelekt: ${ resultObj.statIntelect}</p>
                <p id="statdamage">AD: ${ resultObj.statDamage}</p>
                <p id="statdex">Zręczność: ${ resultObj.statDex}</p>
                <p>HP: <span id="stathp">${ resultObj.statHp}</span>/<span id="maxhp">${ resultObj.maxHp}</span></p>
                <p id="team">Twoja drużyna: <span style="color: ${ resultObj.colorTeam }"> ${ resultObj.team} </span></p>
                <p id="statarmor">Armor: ${ resultObj.statArmor}</p>
                <p id="eqmainhand">Obecnie posiadana broń: ${ resultObj.eqMainHand}</p>
                `;
            })
        }, '1000');

    </script>

