<!DOCTYPE html>
<?php

    require_once('config.php');

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
								
				<div class="col-12 text-center display-4">Dom</div>
				
				<div class="col-12 col-md-6" style="margin-top: 15px;">

                        <?php
                        Anticheat::checkToken();
                        Anticheat::compareIpAddress();

                            if(rand(1, 100) < 10)
                            {
                                RandomEvent::Auto();
                            }
                            elseif(rand(1,100) < 15)
                            {
                                RandomEvent::Dresy();
                            }
                            
                            if(Get::get('co'))
                            {
                                if(Get::get('co') == 'panaceum') {
                                    if(DatabaseManager::selectBySQL("SELECT statIntelect FROM users WHERE id=".$_SESSION['uid'])[0]['statIntelect'] >= 30 && DatabaseManager::selectBySQL("SELECT slyszCoin FROM users WHERE id=".$_SESSION['uid'])[0]['slyszCoin'] >= 20) {
                                        DatabaseManager::updateTable('users', ['statHp' => 'maxHp', 'slyszCoin' => 'slyszCoin-20'], ['id' => $_SESSION['uid']]);
                                        URL::to('alchemia.php');
                                    }
                                    else {

                                        echo '<h3 style="color: red;">Nie masz wystarczająco inteligencji lub Słysz coinów</h3>';
                                        echo '<div class="btn-dark btn-lg href" id="index.php">Powrót do domu</div>';
                                    }
                                }
                                elseif(Get::get('co') == 'kamien') {
                                    if(DatabaseManager::selectBySQL("SELECT statIntelect FROM users WHERE id=".$_SESSION['uid'])[0]['statIntelect'] >= 50 && DatabaseManager::selectBySQL("SELECT slyszCoin FROM users WHERE id=".$_SESSION['uid'])[0]['slyszCoin'] >= 150) {
                                        DatabaseManager::updateTable('users', ['userEnergy' => '100', 'slyszCoin' => 'slyszCoin-20'], ['id' => $_SESSION['uid']]);
                                        URL::to('alchemia.php');
                                    }
                                    else {

                                        echo '<h3 style="color: red;">Nie masz wystarczająco inteligencji lub Słysz coinów</h3>';
                                        echo '<div class="btn-dark btn-lg href" id="index.php">Powrót do domu</div>';
                                    }
                                }  
                                elseif (Get::get('co') == 'depuratus') {
                                    if(DatabaseManager::selectBySQL("SELECT statIntelect FROM users WHERE id=".$_SESSION['uid'])[0]['statIntelect'] >= 500 && DatabaseManager::selectBySQL("SELECT slyszCoin FROM users WHERE id=".$_SESSION['uid'])[0]['slyszCoin'] >= 150) {
                                        
                                        DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-150'], ['id' => $_SESSION['uid']]);

                                        if(rand(1, 4) == 1)
                                        {
                                                DatabaseManager::updateTable('users', ['maxHp' => 'maxHp+10'], ['id' => $_SESSION['uid']]);
                                        }
                                        else
                                            $_SESSION['badDepuratus'] = 'true';
                                        
                                        URL::to('alchemia.php');

                                    }
                                    else {
                                        echo '<h3 style="color: red;">Nie masz wystarczająco inteligencji lub Słysz coinów</h3>';
                                        echo '<div class="btn-dark btn-lg href" id="index.php">Powrót do domu</div>';
                                    }
                                }
                            }
                            else
                            {
                                if(isset($_SESSION['badDepuratus'])) {
                                    echo '<h3 style="color: lightred">Nie udało się zażyć depuratus!</h3>';
                                    unset($_SESSION['badDepuratus']);
                                }
                            
                                echo '<div class="btn-dark btn-lg href" id="alchemia.php?co=panaceum">Panaceum (Wymagana inteligencja: 30, cena 20SC) (Odnawia całe HP)</div>';
                                echo '<div class="btn-dark btn-lg href" id="alchemia.php?co=kamien">Kamień filozoficzny (Wymagana inteligencja: 50, cena 20SC) (Odnawia całą energię)</div>';
                                echo '<div class="btn-dark btn-lg href" id="alchemia.php?co=depuratus">Depuratus (Wymagana inteligencja: 500, cena 150SC, 25% szans na powodzenie) (+10 do MAXHP)</div>';
                                echo '<div class="btn-dark btn-lg href" id="index.php">Powrót do domu</div>';
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
</body>
</html>