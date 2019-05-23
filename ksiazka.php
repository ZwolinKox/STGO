<!DOCTYPE html>
<?php

    require_once('config.php');

    if(isset($_SESSION['fight']) && $_SESSION['fight']) {
        if(basename($_SERVER['PHP_SELF']) != 'fight.php' && basename($_SERVER['PHP_SELF']) != 'fight.php')
            URL::to('fight.php');
    }

    if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false)
        header('Location: index.php');

?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Słysz Symulator Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>


    <style>
        .btn-dark {
            margin-top: 15px;
        }
		
		.btn-dark:hover {
			cursor: pointer;
		}
    </style>
    
</head>
<body style="background-color: rgb(95, 95, 95); color: white;">


    <div class="container-fluid ">
        <div class="row">
            <div style="background-color: rgb(37, 37, 44);" class="col-12">
                <div class="display-4 d-none d-md-block">Słysz Symulator Online</div>
                <div class="display-4 d-md-none">SSO</div>
            </div>
        </div>
    </div>

    <div class="container-fluid d-flex justify-content-center" style="background-color: rgb(50, 50, 58);">
        <div class="row d-flex">
            <?php require_once 'navbar.php' ?>
        </div>
    </div>

    <div class="container"> <!-- ŚRODEK !-->
        <div class="row">
								
				<div class="col-12 text-center display-4">Dom</div>
				
				<div class="col-12 col-md-6" style="margin-top: 15px;">

                    <?php
                        if(Get::exist('profile'))
                        {
                            $playerNick = Get::get('profile');
                            $playerData = DatabaseManager::selectBySQL('SELECT id, username, slyszCoin, xpPoints, maxXp, userLevel, userLeaguePoints, statStrength, statIntelect, eqMainHand, team, boolGuild, guildName FROM users WHERE username="'.$playerNick.'"');
                            
                            if($playerData[0]['id'] != null)
                            {
                                switch ($playerData[0]['team']) {
                                    case '1':
                                        $playerData[0]['team'] = 'LKS 1908 Nędza';
                                        $colorTeam = '#ffcd2b';
                                        break;
                                    case '2':
                                        $playerData[0]['team'] = 'LKS Zgoda Zawada Książęca';
                                        $colorTeam = '#ff1616';
                                        break;
                                    case '3':
                                        $playerData[0]['team'] = 'KS Unia Racibórz';
                                        $colorTeam = '#42c5f4';
                                }

                                $eqMainHandName = EqManager::item($playerData[0]['eqMainHand'], 'colorTag').' '.EqManager::stat($playerData[0]['eqMainHand']);

                                echo '<div class="btn-dark btn-lg href" id="index.php">Powrót</div>';
                                echo '<div class="btn-dark btn-lg href" id="ksiazka.php">Szukaj innego gracza</div><br>';
                                echo '<h3 style="display: inline;"><p>'.UserManager::otherNick($playerData[0]["id"], "span").' (Lvl: '.$playerData[0]["userLevel"].')</p></h3>';
                                
                                $xpPoints = ($playerData[0]['xpPoints'] / $playerData[0]['maxXp']) * 100;
                                echo '
                                <h5>XP:</h5>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="'.$playerData[0]['xpPoints'].'" aria-valuemin="0" aria-valuemax="'.$playerData[0]['maxXp'].'" style="width:'.$xpPoints.'%">
                                    <span style="color: black">'.round($xpPoints, 2).'%</span></div>
                                </div>
                                <p></p>
                                ';
                                echo '<p id="slyszCoin">Słysz Coiny: '.$playerData[0]['slyszCoin'].'</p>';
                                echo '<p id="userleaguepoints">SłyszLeaguePoints: '.$playerData[0]['userLeaguePoints'].'</p><br>';
                                echo '<p id="statstrength">Siła: '.$playerData[0]['statStrength'].'</p>';
                                echo '<p id="statintelect">Intelekt: '.$playerData[0]['statIntelect'].'</p><br>';
                                echo '<p id="team">Twoja drużyna: <span style="color: '.$colorTeam.'">'.$playerData[0]['team'].'</span></p>';
                                echo '<p id="eqmainhand">Obecnie posiadana broń: '.$eqMainHandName.'</p>';
                            }
                            else
                            {
                                echo '<div class="btn-dark btn-lg href" id="ksiazka.php">Powrót</div>';
                                echo '<div class="btn-dark btn-lg href" id="ksiazka.php">Szukaj innego gracza</div><br>';
                                echo '<h3>Nie znaleziono takiego gracza!</h3>';
                            }
                        }
                        else
                        {
                            echo '<br><input class="form-control" type="text" placeholder="Wyszukaj gracza wpisując jego nick!" id="inputNick">';
                            echo '<div class="btn-dark btn-lg" onclick="search()">Szukaj!</div><br>';
                            echo '<div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';

                        }
                    ?>

                </div>
		
		
                <div class="col-12 col-md-6 " style="margin-top: 30px">

                    <?php
                        require_once 'statystyki.php'
                    ?>

                </div>
                
        </div>
    </div> <!-- ŚRODEK -->

	<br/><br/>
    
    <footer style="background-color: rgb(37, 37, 44); padding-top: -10px;" class="footer fixed-bottom text-center">
        Słysz Symulator 2018 &copy; Wszelkie prawa zastrzeżone
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	
        <script>
            function search() {
                var location = "ksiazka.php?profile=" + $('#inputNick').val();
                window.location.replace(location);
            }
        </script>

</body>
</html>