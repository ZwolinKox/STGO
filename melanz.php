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
    <title>Słysz Symulator</title>
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
								
				<div class="col-12 text-center display-4">Melanż</div>
				
				<div class="col-12 col-md-6" style="margin-top: 15px;">

                    <?php

                        if(DatabaseManager::selectBySQL('SELECT dayWeek FROM users WHERE id='.$_SESSION['uid'])[0]['dayWeek'] != 6 ||
                        DatabaseManager::selectBySQL('SELECT slyszCoin FROM users WHERE id='.$_SESSION['uid'])[0]['slyszCoin'] < 20)
                        {
                            echo '<h3 style="color: red;">Nie możesz urządzić melanżu w sobote! Przecież rodzice są w domu, a może nie masz przy sobie 20SC?</h3>';
                            echo '<div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';

                        }
                        else 
                        {
                            echo '<div id="menu">';
                            echo "<h3>Zrób taką imprezę, żeby Sąsiedzi zapamiętali ją na zawsze!</h3>";
                            echo "<h3>Udany melanż wzbogaci Cię o 20SC, ale nieudany zmniejszy ją o 20SC!</h3>";

                            

                            echo "<label for='hardcore'><h2 style='margin-top: 35px;' >Wybierz typ trunków: </h2></label>
                            <select class='form-control' name='hardcore' id='trunki'>
                                    <option value='1'>Soki</option>
                                    <option value='2' style='color: #f76f85;'>Alkohol</option>
                                    <option value='3' style='color: red;'>FreeWaveCOLA</option>
                            </select>";

                            echo "<label for='hardcore'><h2 style='margin-top: 35px;'>Ile ludzi zaprosisz?: </h2></label>
                            <select class='form-control' name='hardcore' id='ludzie'>
                                    <option value='1'>3 najlepszych kumpli</option>
                                    <option value='2'>30 osób z klasy</option>
                                    <option value='3'>Całe Miasto</option>
                            </select>";

                            echo "<label for='hardcore'><h2 style='margin-top: 35px;' >Jaką muzykę puścisz?: </h2></label>
                            <select class='form-control' name='hardcore' id='spiew'>
                                    <option value='1'>Samemu zaśpiewam</option>
                                    <option value='2'>Disco Polo</option>
                                    <option value='3'>Trap</option>
                                    <option value='4'>Polski Rap</option>
                            </select>";

                            echo "<label for='hardcore'><h2 style='margin-top: 35px;' >Kto będzie tańczył?: </h2></label>
                            <select class='form-control' name='hardcore' id='taniec'>
                                    <option value='1'>Samemu zatańczę na stole</option>
                                    <option value='2'>Ja i kolega z klasy</option>
                                    <option value='3'>Wszyscy będą tańczyć</option>
                                    <option value='4'>Wynajęta pani</option>
                            </select>";

                            echo "<label for='hardcore'><h2 style='margin-top: 35px;' >Jakie będą godziny imprezy?: </h2></label>
                            <select class='form-control' name='hardcore' id='godziny'>
                                    <option value='1'>12-20</option>
                                    <option value='2'>18-24</option>
                                    <option value='3'>22-6</option>
                            </select>";

                            echo '<div class="btn-dark btn-lg" id="start">Rozpocznij melanż!</div>';
                            echo '</div>';


                        }
                    ?>

                </div>
		
	
                <div class="col-12 col-md-6 " style="margin-top: 30px">

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
	
    <script>
    document.querySelector('#start').addEventListener('click', () => {
        console.log('xd');
        $.ajax({
            url: "ajax.php",
            method: "post",
            data: {
                co: "melanz",
                trunki:  document.querySelector('#trunki').value,
                ludzie:  document.querySelector('#ludzie').value,
                spiew:  document.querySelector('#spiew').value,
                taniec:  document.querySelector('#trunki').value,
                godziny:  document.querySelector('#godziny').value
            }
        }).done((result) => {
            document.querySelector('#menu').innerHTML = result;
        })
    })
        
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>