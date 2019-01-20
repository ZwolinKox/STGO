
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

        if($stats['eqMainHand'] == 0)
            $stats['eqMainHandName'] = "Brak broni";
        else
            $stats['eqMainHandName'] = DatabaseManager::selectBySQL('SELECT items.name FROM users, items WHERE items.id = users.eqMainHand AND users.id='.$_SESSION['uid'])[0]['name'];


        $stats['procentHp'] = ($stats['statHp'] / $stats['maxHp']) * 100;
        $stats['procentXp'] = ($stats['xpPoints'] / $stats['maxXp']) * 100;
        
        echo '<div id="stats">';
        echo '<h3 style="color: pink" id="username"><p>Witaj '.$stats['username'].'!</p></h3>';
        echo '<p id="dayweek">Dzień tygodnia: '.$stats['dayWeek'].'</p>';    //Nie wiem gdzie ta zmienna bedziemy trzymac, musi to byc wspólne 
        echo '<p id="daygame">Dzień w grze: '.$stats['dayGame'].'</p>';  //To musze dodac to tabeli user bo nie ma xD
        echo '<p id="slyszCoin">Słysz Coiny: '.$stats['slyszCoin'].'</p>';
        echo '
        <h5>XP:</h5>
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="'.$stats['xpPoints'].'" aria-valuemin="0" aria-valuemax="'.$stats['maxXp'].'" style="width:'.$stats['procentXp'].'%">
            <span style="color: black">'.round($stats['procentXp'], 2).'%</span></div>
        </div>
        <p></p>
        ';
        echo '
        <h5>Energia:</h5>
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="'.$stats['userEnergy'].'" aria-valuemin="0" aria-valuemax="100" style="width:'.$stats['userEnergy'].'%">
            <span style="color: black">'.round($stats['userEnergy'], 2).'%</span></div>
        </div>
        <p></p>
        ';
        echo '
        <h5>Punkty życia:</h5>
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="'.$stats['statHp'].'" aria-valuemin="0" aria-valuemax="'.$stats['maxHp'].'" style="width:'.$stats['procentHp'].'%">
            <span style="color: black">'.round($stats['procentHp'], 2).'%</span></div>
        </div>
        <p></p>
        ';
        echo '<p id="userlevel">lvl: '.$stats['userLevel'].'</p>';
        echo '<p id="userleaguepoints">SłyszLeaguePoints: '.$stats['userLeaguePoints'].'</p>';
        echo '<p id="statintelect">Intelekt: '.$stats['statIntelect'].'</p>';
        echo '<p id="statdamage">AD: '.$stats['statDamage'].'</p>';
        echo '<p id="statdex">Zręczność: '.$stats['statDex'].'</p>';
        echo '<p id="team">Twoja drużyna: <span style="color: '.$stats['colorTeam'].'">'.$stats['team'].'</span></p>';
        echo '<p id="statarmor">Armor: '.$stats['statArmor'].'</p>';
        echo '<p id="statstrength">Siła: '.$stats['statStrength'].'</p>';
        echo '<p id="eqmainhand">Obecnie posiadana broń: '.$stats['eqMainHandName'].'</p>';
        echo '</div>';

        $eq1 = $stats['eqSlotOne'];
        $eq2 = $stats['eqSlotTwo'];
        $eq3 = $stats['eqSlotThree'];
        $eq4 = $stats['eqSlotFour'];
        $eq5 = $stats['eqSlotFive'];
        $eq6 = $stats['eqSlotSix'];
        $eq7 = $stats['eqSlotSeven'];
        $eq8 = $stats['eqSlotEight'];

        $eq1name = DatabaseManager::selectBySQL('SELECT name FROM items WHERE id='.$stats['eqSlotOne'])[0]['name'];
        $eq2name = DatabaseManager::selectBySQL('SELECT name FROM items WHERE id='.$stats['eqSlotTwo'])[0]['name'];
        $eq3name = DatabaseManager::selectBySQL('SELECT name FROM items WHERE id='.$stats['eqSlotThree'])[0]['name'];
        $eq4name = DatabaseManager::selectBySQL('SELECT name FROM items WHERE id='.$stats['eqSlotFour'])[0]['name'];
        $eq5name = DatabaseManager::selectBySQL('SELECT name FROM items WHERE id='.$stats['eqSlotFive'])[0]['name'];
        $eq6name = DatabaseManager::selectBySQL('SELECT name FROM items WHERE id='.$stats['eqSlotSix'])[0]['name'];
        $eq7name = DatabaseManager::selectBySQL('SELECT name FROM items WHERE id='.$stats['eqSlotSeven'])[0]['name'];
        $eq8name = DatabaseManager::selectBySQL('SELECT name FROM items WHERE id='.$stats['eqSlotEight'])[0]['name'];


        echo <<< END
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#eq">
          Ekwipunek
        </button>
        
        <!-- Modal -->
        <div style="color: black;" class="modal fade" id="eq" tabindex="-1" role="dialog" aria-labelledby="eqLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="eqLabel">Ekwipunek</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <div class="input-group mb-3">
              <div class="input-group-append">
              <div class="form-group">
              <label for="setEq">Obecnie wybrana broń:</label>
              <select class="form-control" id="setEq">
                <option value="eqSlotOne">1)$eq1name</option>
                <option value="eqSlotTwo">2)$eq2name</option>
                <option value="eqSlotThree">3)$eq3name</option>
                <option value="eqSlotFour">4)$eq4name</option>
                <option value="eqSlotFive">5)$eq5name</option>
                <option value="eqSlotSix">6)$eq6name</option>
                <option value="eqSlotSeven">7)$eq7name</option>
                <option value="eqSlotEight">8)$eq8name</option>
              </select>
            </div>
              </div>
            </div>
              </div>
              <div class="modal-footer">
                <button id="deleteItem" type="button" class="btn btn-danger">Usuń przedmiot</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                <button id="saveEq" type="button" class="btn btn-primary">Zapisz zmiany</button>
              </div>
            </div>
          </div>
        </div>
END;
?>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous" defer></script>
        <script defer>

        document.querySelector('#saveEq').addEventListener('click', () => {
            $.ajax({
            url : "ajax.php",
            method : "POST",
            data : {
                co : "changeItem",
                itemName : document.querySelector('#setEq').value
            }
        })
    })

    document.querySelector('#deleteItem').addEventListener('click', () => {
            $.ajax({
            url : "ajax.php",
            method : "POST",
            data : {
                co : "deleteItem",
                itemName : document.querySelector('#setEq').value
            }
        }).done((result) => {
            location.reload(); 
        })
    })

        setInterval(() => {
            $.ajax({
            url : "ajaxstats.php",
            method : "POST",
            data : {
                ajax : "ajax"
            },
        })
        .done((result) => {
                
            function Round(n, k)
            {
                var factor = Math.pow(10, k);
                return Math.round(n*factor)/factor;
            }
                
            const resultObj = JSON.parse(result);    

            document.querySelector('#stats').innerHTML  = `
                <h3 style="color: pink" id="username"><p>Witaj ${ resultObj.username }!</p></h3>
                <p id="dayweek">Dzień tygodnia: ${ resultObj.dayWeek }</p>
                <p id="daygame">Dzień w grze: ${ resultObj.dayGame }</p>
                <p id="slyszCoin">Słysz Coiny: ${ resultObj.slyszCoin }</p>
                <h5>XP:</h5>
                <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="${ resultObj.xpPoints }" aria-valuemin="0" aria-valuemax="${ resultObj.maxXp }" style="width: ${ resultObj.procentXp }%">
                    <span style="color: black"> ${ Round(resultObj.procentXp, 2) }%</span></div>
                </div>
                <p></p>
                    <h5>Energia:</h5>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="${ resultObj.userEnergy }" aria-valuemin="0" aria-valuemax="100" style="width: ${ resultObj.userEnergy }%">
                        <span style="color: black">${ resultObj.userEnergy }%</span></div>
                    </div>
                <p></p>
                <h5>Punkty życia:</h5>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="${ resultObj.statHp }" aria-valuemin="0" aria-valuemax="${ resultObj.maxHp }" style="width:${ resultObj.procentHp }%">
                    <span style="color: black">${ Round(resultObj.procentHp, 2) }%</span></div>
                </div>
                <p></p>
                <p id="userlevel">lvl: ${ resultObj.userLevel }</p>
                <p id="userleaguepoints">SłyszLeaguePoints: ${ resultObj.userLeaguePoints}</p>
                <p id="statintelect">Intelekt: ${ resultObj.statIntelect}</p>
                <p id="statdamage">AD: ${ resultObj.statDamage}</p>
                <p id="statdex">Zręczność: ${ resultObj.statDex}</p>
                <p id="team">Twoja drużyna: <span style="color: ${ resultObj.colorTeam }"> ${ resultObj.team} </span></p>
                <p id="statarmor">Armor: ${ resultObj.statArmor}</p>
                <p id="statstrength">Siła: ${ resultObj.statStrength}</p>
                <p id="eqmainhand">Obecnie posiadana broń: ${ resultObj.eqMainHandName}</p>
                `;
            })
        }, '1000');

    </script>

