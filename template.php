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
								
				<div class="col-12 text-center display-4">Dom</div>
				
				<div class="col-12 col-md-6" style="margin-top: 15px;">

                        <div class="btn-dark btn-lg href" id="https://www.onet.pl">1. Idz do szkoly (Z wyjatkiem weekendu, raz dziennie)</div>
                        <div class="btn-dark btn-lg href-blank" id="https://www.onet.pl">2. Idz do sklepu</div>
                        <div class="btn-dark btn-lg">3. Napraw komputer</div>
                        <div class="btn-dark btn-lg">4. Idz spac</div>
                        <div class="btn-dark btn-lg">5. Idz wreszcie na silownie</div>
                        <div class="btn-dark btn-lg">6. Wyslij mema na grupe</div>
                        <div class="btn-dark btn-lg">7. Wyzywanie brata</div>
                        <div class="btn-dark btn-lg">8. Zagraj w Slyszolotka</div>
                        <div class="btn-dark btn-lg">9. Idz do pracowni alchemicznej</div>
                        <div class="btn-dark btn-lg">10. Eksploracja</div>
                        <div class="btn-dark btn-lg">11. Idz do kosciola (Dostepne jedynie w niedziele, raz dziennie)</div>

                </div>
		
		
                <div class="col-12 col-md-6 " style="margin-top: 30px">

                    <p>Dzień tygodnia: poniedziałek</p>
                    <p>Dzień w grze: 5</p>
                    <p>Słysz Coiny: 20</p>
                    <p>XP: 100/500</p>
                    <p>lvl: 53</p>
                    <p>SłyszLeaguePoints: 2561</p>
                    <p>Energia: 100</p>
                    <p>Intelekt: 20</p>
                    <p>AD: 50</p>
                    <p>Unik: 30</p>
                    <p>HP: 120/120</p>
                    <p>Krytyk: 25%</p>
                    <p>Armor: 200</p>
                    <p>Absorpcja: 500</p>
                    <p>Obecnie posiadana broń <span style="color: gold;">*LEGENDARNE*</span> Palec Pawła Majnusza</p>

                </div>
                
        </div>
    </div> <!-- ŚRODEK -->

	<br/><br/>
    
    <footer style="background-color: rgb(37, 37, 44); padding-top: -10px;" class="footer fixed-bottom text-center">
        Słysz Symulator 2018 &copy; Wszelkie prawa zastrzeżone
    </footer>
	
	DatabaseManager::selectBySql


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>