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
    <title>Słysz Symulator Online</title>
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
    
    <?php
        if(Get::exist('spanie') && Get::get('spanie') == "tak")
        {
            $dayWeek = DatabaseManager::selectBySQL('SELECT dayWeek FROM users WHERE id='.Session::get('uid'))[0]['dayWeek'];

            $dayWeek++;

            if($dayWeek == 7)
            {
                //Narazie anticheat musi byc wylaczony poniewaz dziala srednio, pracuje nad nowym wydajniejszym i dokładniejszym
                //Anticheat::checkDate();
                DatabaseManager::updateTable('users', ['lastSunday' => "now()"], ['id' => $_SESSION['uid']]);
            }

            if($dayWeek > 7) {
                $dayWeek = 1;
                DatabaseManager::updateTable('users', ['boolChurch' => 0, 'boolSchoolBan' => 0], ['id' => Session::get('uid')]);  
            }
                

            DatabaseManager::updateTable('users', ['userEnergy' => '100', 'statHp' => 'maxHp', 'dayWeek' => $dayWeek, 'dayGame'=>'dayGame+1', 'boolLotek' => 0, 'boolSchool' => 0], ['id' => $_SESSION['uid']]);

            header('Location: dom.php');
            exit();
        }
        else {
            
        }
    ?>
    
    <div class="container"> <!-- ŚRODEK !-->
        <div class="row">
								
				<div class="col-12 text-center display-4">Spanie</div>
				
            
                
            
				<div class="col-12 col-md-6" style="margin-top: 15px;">

                        <h3 style="color: pink;">Czy na pewno chcesz spać? Minie kolejny dzień, a ty odzyskasz siły</h3>
                        <div class="btn-dark btn-lg href" id="spanie.php?spanie=tak">Tak</div>
                        <div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>

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