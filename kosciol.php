<!DOCTYPE html>
<?php

    require_once('config.php');


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
            <div class="col-4 btn btn-dark btn-lg">Profil</div>
            <div class="col-4 btn btn-dark btn-lg">Ranking</div>
            <div class="col-4 btn btn-dark btn-lg">Wyloguj</div>
        </div>
    </div>

    <div class="container"> <!-- ŚRODEK !-->
        <div class="row">
								
				<div class="col-12 text-center display-4">Kościół</div>
				
				<div class="col-12 col-md-6" style="margin-top: 15px;">

                    <?php
                        if(DatabaseManager::selectBySQL("SELECT boolChurch FROM users WHERE id=".$_SESSION['uid'])[0]['slyszCoin'])
                        {
                            echo '<h3 style="color: red;">W tym tygodniu już byłeś w kościele!</h3><br>';
                            echo '<div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                        }
                        else
                        {
                            if(Get::exist('co'))
                            {
                                if(Get::get('co') == 'ofiara')
                                {
                                    if(DatabaseManager::selectBySQL("SELECT slyszCoin FROM users WHERE id=".$_SESSION['uid'])[0]['slyszCoin'] < 1)
                                    {
                                        echo '<h3 style="color: red;">Nie masz tyle Słysz Coinów!</h3><br>';
                                        echo '<div class="btn-dark btn-lg href" id="kosciol.php">Wybierz inną czynność </div>';
                                        echo '<div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                    }
                                    else
                                    {
                                        DatabaseManager::updateTable('users', ['userEnergy' => '100', 'slyszCoin' => 'slyszCoin-1'], ['id' => $_SESSION['uid']]);
                                        echo '<h3 style="color: green;">Twoja energia została odnowiona!</h3>';
                                        $rng = rand(1,3);
                                        switch($rng)
                                        {
                                            case 1:
                                            {
                                                DatabaseManager::updateTable('users', ['statIntelect' => 'statIntelect+1'], ['id' => $_SESSION['uid']]);
                                                echo '<h3 style="color: green;">Twoja inteligencja wzrosła o 1!</h3>';
                                            }break;
                                            case 2:
                                            {
                                                DatabaseManager::updateTable('users', ['maxHp' => 'maxHp+1'], ['id' => $_SESSION['uid']]);
                                                echo '<h3 style="color: green;">Twoja maksymalna liczba punktów zdrowia wzrosła o 1!</h3>';
                                            }break;
                                            case 3:
                                            {
                                                DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin+1'], ['id' => $_SESSION['uid']]);
                                                echo '<h3 style="color: green;">Znalazłes w kieszeni jeszcze jednego Słysz Coina!</h3>';
                                            }break;
                                        }

                                        DatabaseManager::updateTable('users', ['boolChurch' => 'true'], ['id' => $_SESSION['uid']]);

                                        echo '<br><div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                        
                                    }
                                }
                                else if(Get::get('co') == 'kielich')
                                {

                                }
                                else if(Get::get('co') == 'ministrant')
                                {

                                }
                                else if(Get::get('co') == 'piesn')
                                {

                                }
                                else if(Get::get('co') == 'kazanie')
                                {

                                }
                                else if(Get::get('co') == 'koszyk')
                                {
                                    
                                }
                            }
                            else
                            {
                                echo '<div class="btn-dark btn-lg href" id="kosciol.php?co=ofiara">Daj na ofiarę (Koszt to 1 Słysz Coin)</div>';
                                echo '<div class="btn-dark btn-lg href" id="kosciol.php?co=kielich">Napij się z kielicha</div>';
                                echo '<div class="btn-dark btn-lg href" id="kosciol.php?co=ministrant">Zaczep ministrantów</div>';
                                echo '<div class="btn-dark btn-lg href" id="kosciol.php?co=piesn">Zaśpiewaj pieśń</div>';
                                echo '<div class="btn-dark btn-lg href" id="kosciol.php?co=kazanie">Powiedz kazanie</div>';
                                echo '<div class="btn-dark btn-lg href" id="kosciol.php?co=koszyk">Okradnij koszyk</div>';
                                echo '<br><div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
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
</body>
</html>