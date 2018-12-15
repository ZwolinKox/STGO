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
								
				<div class="col-12 text-center display-4">Naprawa komputera</div>
				
				<div class="col-12 col-md-6" style="margin-top: 15px;">

                        <?php

                            if(Get::exist('naprawa'))
                            {
                                if(Get::get('naprawa') == 'tak')
                                {
                                    if(DatabaseManager::selectBySQL("SELECT userEnergy FROM users WHERE id=".$_SESSION['uid'])[0]['userEnergy'] < 20)
                                    {
                                        echo '<h3 style="color: red;">Nie masz tyle energii!</h3>';
                                        echo '<br> <div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                    }
                                    else if(DatabaseManager::selectBySQL("SELECT slyszCoin FROM users WHERE id=".$_SESSION['uid'])[0]['slyszCoin'] < 30)
                                    {

                                        echo '<h3 style="color: red;">Nie masz tyle słysz coinów!</h3>';
                                        echo '<br> <div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                    }
                                    else{
                                        $szansaNaNaprawe = 4000;
                                        DatabaseManager::updateTable('users', ['userEnergy' => 'userEnergy-20', 'slyszCoin' => 'slyszCoin-30'], ['id' => $_SESSION['uid']]);
                                        if(rand(1, 10000) <= 4000) {

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
    
                                            DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin+'.$hajs], ['id' => $_SESSION['uid']]);

                                            echo '<h3 style="color: gold;">Udało Ci się naprawić komputer! Zarobione SC: '.$hajs;
                                            
                                            echo '</h3>';
                                            echo '<br> <div class="btn-dark btn-lg href" id="napraw-komputer.php">Naprawiaj komputer ponownie</div>';
                                            echo '<br> <div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
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

                                            DatabaseManager::updateTable('users', ['statHp' => 'statHp-'.$dmg], ['id' => $_SESSION['uid']]);

                                            if(DatabaseManager::selectBySQL('SELECT statHp FROM users WHERE id='.$_SESSION['uid'])[0]['statHp'] <= 0)
                                                UserManager::death();


                                            echo '<h3 style="color: red;">Nie udało Ci się, spaliłeś RAM! Otrzymane obrażenia: '.$dmg; 
                                            
                                            echo '</h3>';
                                            echo '<br> <div class="btn-dark btn-lg href" id="napraw-komputer.php">Naprawiaj komputer ponownie</div>';
                                            echo '<br> <div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                        }
                                    }



                                }
                            }
                            else 
                            {
                                if(DatabaseManager::selectBySQL("SELECT userEnergy FROM users WHERE id=".$_SESSION['uid'])[0]['userEnergy'] < 20)
                                {
                                    echo '<h3 style="color: red;">Nie masz tyle energii!</h3>';
                                    echo '<br> <div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                }
                                else {
                                    if(DatabaseManager::selectBySQL("SELECT statHp FROM users WHERE id=".$_SESSION['uid'])[0]['statHp'] < 31)
                                    {
                                        echo '<h3 style="color: pink;">Uwaga! Masz mało punktów życia, ta operacja może zakończyć się śmiercią!</h3>';
                                    }
    
                                    echo '<h3>Chcesz naprawiać komputer?</h3>';
    
                                    echo '<br> <div class="btn-dark btn-lg href" id="napraw-komputer.php?naprawa=tak">Tak </div>';
                                    echo '<br> <div class="btn-dark btn-lg href" id="index.php">Nie</div>';
                                    echo '<br> <div class="btn-dark btn-lg href" id="napraw-komputer.php?naprawa=koparka">Chcę złożyć koparkę słyszcoinów</div>';
    
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