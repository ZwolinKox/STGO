<!DOCTYPE html>
<?php

    require_once('config.php');


    require_once('checkLogin.php');


    CheckUrl::check();

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
								
				<div class="col-12 text-center display-4">Naprawa komputera</div>
				
				<div class="col-12 col-md-6" style="margin-top: 15px;">

                        <?php
                        Anticheat::checkToken();
                        Anticheat::compareIpAddress();

                            if(Get::exist('naprawa'))
                            {
                                if(Get::get('naprawa') == 'tak')
                                {
                                    if(Action::getEnergy() < 20)
                                    {
                                        echo '<h3 style="color: red;">Nie masz tyle energii!</h3>';
                                        echo '<br> <div class="btn-dark btn-lg href" id="dom.php">Wróć do domu </div>';
                                    }
                                    else if(Action::getCoins() < 30)
                                    {

                                        echo '<h3 style="color: red;">Nie masz tyle słysz coinów!</h3>';
                                        echo '<br> <div class="btn-dark btn-lg href" id="dom.php">Wróć do domu </div>';
                                    }
                                    else{
                                        DatabaseManager::updateTable('users', ['userEnergy' => 'userEnergy-20', 'slyszCoin' => 'slyszCoin-30'], ['id' => $_SESSION['uid']]);
                                        if(rand(1, 100) <= 25) {

                                            $hajs = rand(0, 2);

                                            switch ($hajs) {
                                                case 0:
                                                    $hajs = 50;
                                                    break;
                                                    case 1:
                                                    $hajs = 60;
                                                    break;
                                                    case 2:
                                                    $hajs = 70;
                                                    break;
                                            }
    
                                            Action::addCoin($hajs);

                                            echo '<h3 style="color: gold;">Udało Ci się naprawić komputer! Zarobione SC: '.$hajs;
                                            
                                            echo '</h3>';
                                            echo '<br> <div class="btn-dark btn-lg href" id="napraw-komputer.php">Naprawiaj komputer ponownie</div>';
                                            echo '<br> <div class="btn-dark btn-lg href" id="dom.php">Wróć do domu </div>';
                                        }
                                        else {
                                            
                                            $dmg = rand(0, 3);

                                            switch ($dmg) {
                                                case 0:
                                                    $dmg = 5;
                                                    break;
                                                    case 1:
                                                    $dmg = 15;
                                                    break;
                                                    case 2:
                                                    $dmg = 20;
                                                    break;
                                                    case 3:
                                                    $dmg = 30;
                                                    break;
                                            }

                                            Action::delHp($dmg);

                                            echo '<h3 style="color: red;">Nie udało Ci się, spaliłeś RAM! Otrzymane obrażenia: '.$dmg; 
                                            
                                            echo '</h3>';
                                            echo '<br> <div class="btn-dark btn-lg href" id="napraw-komputer.php">Naprawiaj komputer ponownie</div>';
                                            echo '<br> <div class="btn-dark btn-lg href" id="dom.php">Wróć do domu </div>';
                                        }
                                    }



                                }
                                else if(Get::get('naprawa')== 'koparka')
                                {
                                    if(DatabaseManager::selectBySQL("SELECT boolKoparka FROM users WHERE id=".$_SESSION['uid'])[0]['boolKoparka'] != 1)
                                    {
                                        $elementsValue = DatabaseManager::selectBySQL('SELECT collectElik, collectElyk, collectInfo, collectEnod FROM users WHERE id='.$_SESSION['uid']);

                                        echo '<br><h3 style="text-align: center;">Częsci od elektroników!</h3>';
                                        echo '<div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="'.$elementsValue[0]['collectElik'].'" aria-valuemin="0" aria-valuemax="100" style="width: '.$elementsValue[0]['collectElik'].'%"></div>
                                        </div><br>';
                                        echo '<h3 style="text-align: center;">Częsci od elektryków!</h3>';
                                        echo '<div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="'.$elementsValue[0]['collectElyk'].'" aria-valuemin="0" aria-valuemax="100" style="width: '.$elementsValue[0]['collectElyk'].'%"></div>
                                        </div><br>';
                                        echo '<h3 style="text-align: center;">Częsci od informatyków!</h3>';
                                        echo '<div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="'.$elementsValue[0]['collectInfo'].'" aria-valuemin="0" aria-valuemax="100" style="width: '.$elementsValue[0]['collectInfo'].'%"></div>
                                        </div><br>';
                                        echo '<h3 style="text-align: center;">Częsci od energi odnawialnej!</h3>';
                                        echo '<div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="'.$elementsValue[0]['collectEnod'].'" aria-valuemin="0" aria-valuemax="100" style="width: '.$elementsValue[0]['collectEnod'].'%"></div>
                                        </div><br>';

                                        if(($elementsValue[0]['collectElik']>=100)&&($elementsValue[0]['collectElyk']>=100)&&($elementsValue[0]['collectInfo']>=100)&&($elementsValue[0]['collectEnod']>=100))
                                        {
                                            echo '<br> <div class="btn-dark btn-lg" onclick="build()">Zbuduj koparke! (Koszt: 1000SC)</div>'; 
                                        }
                                        else
                                        {
                                            echo '<h3 style="color: red;">Nie masz wystarczającej ilości części!</h3>';
                                        }

                                        echo '<br> <div class="btn-dark btn-lg href" id="napraw-komputer.php">Wróć</div>';

                                    }
                                    else
                                    {
                                        $elementsValue = DatabaseManager::selectBySQL('SELECT collectElik, collectElyk, collectInfo, collectEnod, levelKoparka FROM users WHERE id='.$_SESSION['uid']);

                                        echo '<h3>Poziom twojej koparki: '.$elementsValue[0]['levelKoparka'].'</h3>';
                                        echo '<h3>Dziennie zarabiasz: '.Miner::minerGain($elementsValue[0]['levelKoparka']).'</h3>';

                                        if($elementsValue[0]['levelKoparka'] < 5)
                                        {
                                            echo '<br><h3 style="text-align: center;">Częsci od elektroników!</h3>';
                                            echo '<div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="'.$elementsValue[0]['collectElik'].'" aria-valuemin="0" aria-valuemax="100" style="width: '.$elementsValue[0]['collectElik'].'%"></div>
                                            </div><br>';
                                            echo '<h3 style="text-align: center;">Częsci od elektryków!</h3>';
                                            echo '<div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="'.$elementsValue[0]['collectElyk'].'" aria-valuemin="0" aria-valuemax="100" style="width: '.$elementsValue[0]['collectElyk'].'%"></div>
                                            </div><br>';
                                            echo '<h3 style="text-align: center;">Częsci od informatyków!</h3>';
                                            echo '<div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="'.$elementsValue[0]['collectInfo'].'" aria-valuemin="0" aria-valuemax="100" style="width: '.$elementsValue[0]['collectInfo'].'%"></div>
                                            </div><br>';
                                            echo '<h3 style="text-align: center;">Częsci od energi odnawialnej!</h3>';
                                            echo '<div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="'.$elementsValue[0]['collectEnod'].'" aria-valuemin="0" aria-valuemax="100" style="width: '.$elementsValue[0]['collectEnod'].'%"></div>
                                            </div><br>';

                                            if(($elementsValue[0]['collectElik']>=100)&&($elementsValue[0]['collectElyk']>=100)&&($elementsValue[0]['collectInfo']>=100)&&($elementsValue[0]['collectEnod']>=100))
                                            {
                                                echo '<br> <div class="btn-dark btn-lg" onclick="upgrade()">Ulepsz koparke!</div>'; 
                                            }
                                            else
                                            {
                                                echo '<br><h3 style="color: red;">Nie masz wystarczającej ilości części na ulepszenie!</h3>';
                                            }
                                        }
                                        else
                                        {
                                            echo '<br><h3 style="color: lightgreen;">Masz maksymalny poziom koparki!</h3>';
                                        }

                                        echo '<br> <div class="btn-dark btn-lg href" id="napraw-komputer.php">Wróć</div>';
                                    }
                                }
                            }
                            else 
                            {
                                if(Action::getEnergy() < 20)
                                {
                                    echo '<h3 style="color: red;">Nie masz tyle energii!</h3>';
                                    echo '<br> <div class="btn-dark btn-lg href" id="dom.php">Wróć do domu </div>';
                                }
                                else 
                                {
                                    echo '<h3>Chcesz naprawiać komputer? (Koszt 30SC, 20 energii)</h3>';
    
                                    echo '<br> <div class="btn-dark btn-lg href" id="napraw-komputer.php?naprawa=tak">Tak </div>';
                                    echo '<br> <div class="btn-dark btn-lg href" id="dom.php">Nie</div>';
                                    echo '<br> <div class="btn-dark btn-lg href" id="napraw-komputer.php?naprawa=koparka">Koparka Słysz Coinów</div>';
    
                                }
                            }
                            

                        ?>
                </div>
		
		
                <div class="col-12 col-md-6 " style="margin-top: 30px">

                    <!-- Uzupełnij po bazy danych! -->

                    <?php 
                    require_once 'statystyki.php';
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
        function build() {
            $.ajax({
            url: "ajax.php",
            method: "post",
            data: {
                co: "build"
            }
            })
        parent.window.location.reload();
        }
    </script>

    <script>
        function upgrade() {
            $.ajax({
            url: "ajax.php",
            method: "post",
            data: {
                co: "upgrade"
            }
            })
        parent.window.location.reload();
        }
    </script>

</body>
</html>