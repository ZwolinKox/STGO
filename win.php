<!DOCTYPE html>
<?php

    require_once('config.php');

    CheckUrl::check();

    if(isset($_SESSION['fight']) && $_SESSION['fight']) {
        if(basename($_SERVER['PHP_SELF']) != 'fight.php' && basename($_SERVER['PHP_SELF']) != 'fight.php')
            URL::to('fight.php');
    }

   if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false)
        header('Location: index.php');

        if(!isset($_SESSION['win']) || $_SESSION['win'] == false)
            header('Location: index.php');
        else
            unset($_SESSION['win']);

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
								
				<div class="col-12 text-center display-4">Lvl Up!</div>
				
				<div class="col-12 col-md-6" style="margin-top: 15px;">

                    <div class="display-3" style="color: lightgreen;">Gratulacje! Wygrałeś</div>

                    <h3 style="margin-top: 50px;">Zdobyłeś <span style="color: gold"><?php echo $_SESSION['enemyInfo']['dropSlyszCoin'];?></span> SłyszCoinów!</h3>
                    
                    <?php
                    if(isset($_SESSION['enemyInfo']['dropItem'])) {
                        $color = 'style="color: lightblue"';
                        echo '<h3>Z tej walki wyniosłeś również przedmiot o nazwie: <span '.$color.'>'.$_SESSION['enemyInfo']['dropItem']. "</span> </h3>";
                    }

                    if(isset($_SESSION['enemyInfo']['isFull']) && $_SESSION['enemyInfo']['isFull'])
                    {
                        echo '<h3 style="color: red">Twój ekwipunek był pełny, przedmiot przepadł!</h3>';
                    }
                        
                    unset($_SESSION['enemyInfo']);

                    ?>

                    <?php
                        
                        if(isset($_SESSION['lvlup'])) {
                            echo '<h3>Gratulacje! Osiągnąłeś poziom <span style="color: gold;">'.DatabaseManager::selectBySQL('SELECT userLevel FROM users WHERE id='.$_SESSION['uid'])[0]['userLevel']."</span></h3>";
                            unset($_SESSION['lvlup']);
                        }
                        
                    ?>

                    <br> <div class="btn-dark btn-lg href" id="index.php">Wróć do domu</div>

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