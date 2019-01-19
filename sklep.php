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
								
				<div class="col-12 text-center display-4">Sklep</div>
				
				<div class="col-12 col-md-6" style="margin-top: 15px;">

                       <?php

                            echo '<h3>Oto rzeczy dostępne dla ciebie!</h3>';

                            echo '<br><div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div><br>';

                            //od 1 do 10
                            
                                echo '<div class="btn-dark btn-lg shop" id="1">Patyk</div>';
                                echo '<div class="btn-dark btn-lg shop" id="2">Puszka</div>';
                                echo '<div class="btn-dark btn-lg shop" id="3">Ostryk patyk</div>';
                                echo '<div class="btn-dark btn-lg shop" id="4">Zgnieciona puszka</div>';
                                echo '<div class="btn-dark btn-lg shop" id="5">Plastikowy widelec</div>';
                                echo '<div class="btn-dark btn-lg shop" id="6">Zabawkowy kostur</div>';
                                echo '<div class="btn-dark btn-lg shop" id="7">Butelka CocaCola</div>';
                                echo '<div class="btn-dark btn-lg shop" id="8">Butelka Pepsi</div>';
                                echo '<div class="btn-dark btn-lg shop" id="9">Plastikowy miecz</div>';
                                echo '<div class="btn-dark btn-lg shop" id="10">Plastikowa różdżka</div>';
                            
                            //od 11 do 20

                                echo '<div class="btn-dark btn-lg shop" id="11">Ekierka</div>';
                                echo '<div class="btn-dark btn-lg shop" id="12">Kreda</div>';
                                echo '<div class="btn-dark btn-lg shop" id="13">Linijka</div>';
                                echo '<div class="btn-dark btn-lg shop" id="14">Figura geometryczna</div>';
                                echo '<div class="btn-dark btn-lg shop" id="15">Ram Mojżesza</div>';
                                echo '<div class="btn-dark btn-lg shop" id="16">Dysk Mojżesza</div>';
                                echo '<div class="btn-dark btn-lg shop" id="17">Piórnik</div>';
                                echo '<div class="btn-dark btn-lg shop" id="18">Reklamówka</div>';
                            
                            //od 21 do 30
                            
                                echo '<div class="btn-dark btn-lg shop" id="19">Nóż do masła</div>';
                                echo '<div class="btn-dark btn-lg shop" id="20">Zamek z bluzy</div>';
                                echo '<div class="btn-dark btn-lg shop" id="21">Cyrkiel</div>';
                                echo '<div class="btn-dark btn-lg shop" id="22">Kątomierz</div>';
                                echo '<div class="btn-dark btn-lg shop" id="23">Prawie prawdziwy miecz</div>';
                                echo '<div class="btn-dark btn-lg shop" id="24">Prawie prawdziwa różdżka</div>';
                                echo '<div class="btn-dark btn-lg shop" id="25">Prawdziwy miecz</div>';
                                echo '<div class="btn-dark btn-lg shop" id="26">Prawdziwa różdżka</div>';
                                echo '<div class="btn-dark btn-lg shop" id="27">Kij baseballowy</div>';
                                echo '<div class="btn-dark btn-lg shop" id="28">Znak drogowy</div>';
                                echo '<div class="btn-dark btn-lg shop" id="29">Niejednoznaczny miecz</div>';
                                echo '<div class="btn-dark btn-lg shop" id="30">Magia w proszku</div>';
                            
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
        function buy(itemid) {
            $.ajax({
            url : "ajax.php",
            method : "POST",
            data : {
                co: "sklep",
                id: itemid
            }   
            })
        }

        document.addEventListener('DOMContentLoaded', () =>  {

        let buttons = document.querySelectorAll('.shop');
            
        for(let i = 0; i < buttons.length; i++) {
            const thisButton = buttons[i];
            buttons[i].addEventListener('click', () => {
                buy(thisButton.id);
            })
        }
    })

    </script>


</body>
</html>