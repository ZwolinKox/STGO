<!DOCTYPE html>
<?php

    require_once('config.php');


    if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false)
        header('Location: index.php');

        if(DatabaseManager::selectBySQL('SELECT * FROM fight WHERE status=0 AND (playerOne='.$_SESSION['uid'].' OR playerTwo='.$_SESSION['uid'].')')) {
            URL::to('pvp.php');
            exit();
        }

        $_SESSION['winWithMonster'] = false;


?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Słysz Symulator Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
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
								
				<div class="col-12 text-center display-4">Walka z <?php echo $_SESSION['enemyInfo']['name']." Lvl: ".$_SESSION['enemyInfo']['enemyLevel']?></div>
				
				<div class="col-12 col-md-6" style="margin-top: 15px;">

                    <?php
                        
                        if(!isset($_SESSION['fight']))
                            URL::to('index.php');
                            
                        else {
                            
                            echo "<div class='text-center' id='walka'> </div> 
                            
                            ";

                            echo '<div id="cios" style="margin-top: 75px;" class="btn-dark btn-lg">Zadaj cios</div>
                            <div id="ucieczka" class="btn-dark btn-lg">Uciekaj (Utrata całej energii, koszt 200SC)</div>';

                            echo '<div id="logs" style="margin-top: 35px;"></div>';

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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>    <script src="https://code.jquery.com/jquery-3.3.1.min.js"integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous" defer></script>


    <script>
    
        let fightEnd = false;

        function Round(n, k)
        {
            var factor = Math.pow(10, k);
            return Math.round(n*factor)/factor;
        }

		function attack() {
			$.ajax({
                        url: "getEnemyStats.php",
                        method: "post",
                        data: {
                            co : 'Cios'
                        }
                        }).done((result) => {

                            if(result == 'win')
                                location.href = "win.php"
                            else
                                document.querySelector('#logs').innerHTML = result;
                        })
		}

        document.addEventListener('DOMContentLoaded', () => {
            const container = document.querySelector('#walka');

            container.innerHTML = '<h3 style="margin-top: 25px; margin-bottom: 50px;">Trwa ładowanie statystyk...</h3>  <div id="search" class="spinner-border" role="status" style="width: 9rem; height: 9rem;"> <span class="sr-only">Loading...</span> </div>'
            
            setInterval(() => {
                
                $.ajax({
                        url: "getEnemyStats.php",
                        method: "post",
                        data: {
                            co : 'getEnemyStats'
                        }
                        
                    }).done((result) => {
                        let resultObj = JSON.parse(result);
						

                        container.innerHTML = `

                            <h3 style="margin-bottom: 25px; margin-top: 25px;">Pancerz przeciwnika: </h3>
                            <div class="progress">
                                <div class="progress-bar progress-bar bg-success progress-bar-animated" role="progressbar" aria-valuenow="${ resultObj.enemyArmor }" aria-valuemin="0" aria-valuemax="${ resultObj.enemyMaxArmor }" style="width: ${ resultObj.enemyArmorProcent }%">
                                <span style="color: black">${ resultObj.enemyArmor }/${ resultObj.enemyMaxArmor } ${ Round(resultObj.enemyArmorProcent, 2) }%</span></div>
                            </div>
                            
                            <h3 style="margin-bottom: 25px; margin-top: 25px;">Punkty życia przeciwnika: </h3>
                            <div class="progress">
                                <div class="progress-bar progress-bar bg-danger progress-bar-animated" role="progressbar" aria-valuenow="${ resultObj.enemyHp }" aria-valuemin="0" aria-valuemax="${ resultObj.enemyMaxHp }" style="width: ${ resultObj.enemyHpProcent }%">
                                <span style="color: black">${ resultObj.enemyHp }/${ resultObj.enemyMaxHp } ${ Round(resultObj.enemyHpProcent, 2) }%</span></div>
                            </div>

                            <h3 style="margin-top: 25px;">Atak: ${ resultObj.enemyDamage } + 1-35% wartości ataku</h3>

                        `;
                    })
                    
            }, '1000');
        });
		
			
		window.addEventListener('keydown', function(event) {
			
			const key = event.keyCode;
			
			if(key == 32)
				attack();
		
		}, false);

        document.querySelector('#cios').addEventListener('click', () => {
            attack();
        })

        document.querySelector('#ucieczka').addEventListener('click', () => {
                        $.ajax({
                        url: "getEnemyStats.php",
                        method: "post",
                        data: {
                            co : 'Ucieczka'
                        }
                        }).done((result) => {
                            console.log(result);
                            if(result == 'yes')
                                location.href = "index.php"
                           
                        })
        })

    </script>

</body>
</html>