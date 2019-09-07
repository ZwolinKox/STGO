<!DOCTYPE html>
<?php

    require_once('config.php');

    CheckUrl::check();

    require_once('checkLogin.php');


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
								
				<div class="col-12 text-center display-4">Siłownia</div>
				
				<div class="col-12 col-md-6" style="margin-top: 15px;">

                    <?php
                    Anticheat::checkToken();
                    Anticheat::compareIpAddress();

                        if(rand(1,100) < 15)
                        {
                            RandomEvent::Dresy();
                        }
                            if(Get::exist('co'))
                            {
                                if(Get::get('co') == 'lapy')
                                {
                                    if(rand(1, 100) < 5)
                                    {
                                        RandomEvent::Sztanga();
                                    }
                                    else
                                    {
                                        if(Action::getEnergy() < 30)
                                        {
                                                echo '<h3 style="color: red;">Nie masz tyle energii!</h3>';
                                                echo '<br> <div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                        }
                                        else if(Action::getCoins() < 20)
                                        {
                                                echo '<h3 style="color: red;">Nie masz tyle Słysz Coinów!</h3>';
                                                echo '<br> <div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                        }
                                        else
                                        {
                                            Action::delEnergy(30);
                                            Action::delCoin(20);
                                            Action::addStrength(5);

                                            echo "<h3 style='color: lightgreen;'>Udało ci się zwykiększyć swoją siłę o 1!</h3><br>";  

                                            unset($szansa);
                                            echo '<div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                            echo '<div class="btn-dark btn-lg href" id="silownia.php">Wróć do ćwiczeń </div>';
                                        
                                        }
                                    }
                                }
                                else if(Get::get('co') == 'nogi')
                                {
                                    if(rand(1, 100) < 5)
                                    {
                                        RandomEvent::Sztanga();
                                    }
                                    else
                                    {
                                        if(Action::getEnergy() < 40)
                                        {
                                                echo '<h3 style="color: red;">Nie masz tyle energii!</h3>';
                                                echo '<br> <div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                        }
                                        else if(Action::getCoins() < 25)
                                        {
                                                echo '<h3 style="color: red;">Nie masz tyle Słysz Coinów!</h3>';
                                                echo '<br> <div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                        }
                                        else
                                        {
                                            $str = rand(0, 10);
                                            
                                            Action::delEnergy(40);
                                            Action::delCoin(25);

                                            if($str > 0) {
                                                Action::addStrength($str); 
                                                echo "<h3 style='color: lightgreen;''>Udało ci się zwykiększyć swoją siłę o $str!</h3><br>";  
                                            }
                                            else
                                            {
                                                echo '<h3 style="color: red;">Nie udało ci sie zwiększyć swojej siły!</h3><br>';
                                            }
                                            
                                            unset($szansa);
                                            echo '<div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                            echo '<div class="btn-dark btn-lg href" id="silownia.php">Wróć do ćwiczeń </div>';
                                        
                                        }
                                    }
                                }
                            }
                            else
                            {

                                echo '<h3>Co chcesz ćwiczyć?</h3>';
                                echo '<br> <div class="btn-dark btn-lg href" id="silownia.php?co=lapy">Łapy (Koszt: 30Energii, 20Słysz Coinów) </div>';
                                echo '     <div class="btn-dark btn-lg href" id="silownia.php?co=nogi">Nogi (Koszt: 40Energii, 25Słysz Coinów) </div>';

                                echo '<br> <div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
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