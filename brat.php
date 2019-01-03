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
            <?php require_once 'navbar.php' ?>
        </div>
    </div>

    <div class="container"> <!-- ŚRODEK !-->
        <div class="row">
								
				<div class="col-12 text-center display-4">Brat</div>
				
				<div class="col-12 col-md-6" style="margin-top: 15px;">

                       <?php
                            if(Get::exist('jak'))
                            {
                                if(Get::get('jak') == 'smiech')
                                {
                                    if(DatabaseManager::selectBySQL("SELECT userEnergy FROM users WHERE id=".$_SESSION['uid'])[0]['userEnergy'] < 100)
                                    {
                                        echo '<h3 style="color: red;">Nie masz tyle energii!</h3>';
                                        echo '<br> <div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                    }
                                    else
                                    {
                                        DatabaseManager::updateTable('users', ['userEnergy' => 'userEnergy-100'], ['id' => $_SESSION['uid']]);
                                        if(rand(1,100) <= 60)
                                        {
                                            DatabaseManager::updateTable('users', ['userEnergy' => 'userEnergy+50', 'slyszCoin' => 'slyszCoin+5'], ['id' => $_SESSION['uid']]);
                                            echo '<h3 style="color: green;">Twój brat wygląda na zdenerwowanego! Zarobiłeś 5 Słysz Coin i odzyskałeś 50 Energii</h3><br>';
                                        }
                                        else
                                        {
                                            echo '<h3 style="color: red;">Twojego brata to nie rusza, a rodzice nie są zadowoleni!</h3><br>';
                                        }

                                        echo '<div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                    }
                                }
                                else if(Get::get('jak') == 'zwierze')
                                {
                                    if(DatabaseManager::selectBySQL("SELECT userEnergy FROM users WHERE id=".$_SESSION['uid'])[0]['userEnergy'] < 100)
                                    {
                                        echo '<h3 style="color: red;">Nie masz tyle energii!</h3>';
                                        echo '<br> <div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                    }
                                    else
                                    {
                                        DatabaseManager::updateTable('users', ['userEnergy' => 'userEnergy-100'], ['id' => $_SESSION['uid']]);
                                        if(rand(1,100) <= 50)
                                        {
                                            DatabaseManager::updateTable('users', ['userEnergy' => 'userEnergy+50', 'slyszCoin' => 'slyszCoin+10'], ['id' => $_SESSION['uid']]);
                                            echo '<h3 style="color: green;">Twój brat wygląda na zdenerwowanego! Zarobiłeś 10 Słysz Coin i odzyskałeś 50 Energii</h3><br>';
                                        }
                                        else
                                        {
                                            echo '<h3 style="color: red;">Twojego brata to nie rusza, a rodzice nie są zadowoleni!</h3><br>';
                                        }

                                        echo '<div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                    }
                                }
                                else if(Get::get('jak') == 'palec')
                                {
                                    if(DatabaseManager::selectBySQL("SELECT userEnergy FROM users WHERE id=".$_SESSION['uid'])[0]['userEnergy'] < 100)
                                    {
                                        echo '<h3 style="color: red;">Nie masz tyle energii!</h3>';
                                        echo '<br> <div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                    }
                                    else
                                    {
                                        DatabaseManager::updateTable('users', ['userEnergy' => 'userEnergy-100'], ['id' => $_SESSION['uid']]);
                                        if(rand(1,100) <= 40)
                                        {
                                            DatabaseManager::updateTable('users', ['userEnergy' => 'userEnergy+50', 'slyszCoin' => 'slyszCoin+20'], ['id' => $_SESSION['uid']]);
                                            echo '<h3 style="color: green;">Twój brat wygląda na zdenerwowanego! Zarobiłeś 20 Słysz Coin i odzyskałeś 50 Energii</h3><br>';
                                        }
                                        else
                                        {
                                            echo '<h3 style="color: red;">Twojego brata to nie rusza, a rodzice nie są zadowoleni!</h3><br>';
                                        }

                                        echo '<div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                    }
                                }
                                else if(Get::get('jak') == 'wulgaryzmy')
                                {
                                    if(DatabaseManager::selectBySQL("SELECT userEnergy FROM users WHERE id=".$_SESSION['uid'])[0]['userEnergy'] < 100)
                                    {
                                        echo '<h3 style="color: red;">Nie masz tyle energii!</h3>';
                                        echo '<br> <div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                    }
                                    else
                                    {
                                        DatabaseManager::updateTable('users', ['userEnergy' => 'userEnergy-100'], ['id' => $_SESSION['uid']]);
                                        if(rand(1,100) <= 30)
                                        {
                                            DatabaseManager::updateTable('users', ['userEnergy' => 'userEnergy+50', 'slyszCoin' => 'slyszCoin+30'], ['id' => $_SESSION['uid']]);
                                            echo '<h3 style="color: green;">Twój brat wygląda na zdenerwowanego! Zarobiłeś 30 Słysz Coin i odzyskałeś 50 Energii</h3><br>';
                                        }
                                        else
                                        {
                                            echo '<h3 style="color: red;">Twojego brata to nie rusza, a rodzice nie są zadowoleni!</h3><br>';
                                        }

                                        echo '<div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                    }
                                }
                                else if(Get::get('jak') == 'rodzice')
                                {
                                    if(DatabaseManager::selectBySQL("SELECT userEnergy FROM users WHERE id=".$_SESSION['uid'])[0]['userEnergy'] < 100)
                                    {
                                        echo '<h3 style="color: red;">Nie masz tyle energii!</h3>';
                                        echo '<br> <div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                    }
                                    else
                                    {
                                        DatabaseManager::updateTable('users', ['userEnergy' => 'userEnergy-100'], ['id' => $_SESSION['uid']]);
                                        if(rand(1,100) <= 10)
                                        {
                                            DatabaseManager::updateTable('users', ['userEnergy' => 'userEnergy+50', 'slyszCoin' => 'slyszCoin+320'], ['id' => $_SESSION['uid']]);
                                            echo '<h3 style="color: green;">Twój brat wygląda na zdenerwowanego! Zarobiłeś 320 Słysz Coin i odzyskałeś 50 Energii</h3><br>';
                                        }
                                        else
                                        {
                                            echo '<h3 style="color: red;">Twojego brata to nie rusza, a rodzice nie są zadowoleni!</h3><br>';
                                        }

                                        echo '<div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                    }
                                }
                            }
                            else
                            {

                                echo '<div class="btn-dark btn-lg href" id="brat.php?jak=smiech">Zacznij się z niego śmiać (60% szans na powodzenie, koszt 100 Energii)</div>';
                                echo '<div class="btn-dark btn-lg href" id="brat.php?jak=zwierze">Porównaj do zwierzęcia (50% szans na powodzenie, koszt 100 Energii)</div>';
                                echo '<div class="btn-dark btn-lg href" id="brat.php?jak=palec">Pokaż mu środkowy palec (40% szans na powodzenie, koszt 100 Energii)</div>';
                                echo '<div class="btn-dark btn-lg href" id="brat.php?jak=wulgaryzmy">Użyj wulgaryzmów (30% szans na powodzenie, koszt 100 Energii)</div>';
                                echo '<div class="btn-dark btn-lg href" id="brat.php?jak=rodzice">Zacznij obrażać mu rodziców (10% szans na powodzenie, koszt 100 Energii)</div>';
                                echo '<br><div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
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