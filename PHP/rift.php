<!DOCTYPE html>
<?php

    require_once('config.php');

    if(isset($_SESSION['fight']) && $_SESSION['fight']) {
        if(basename($_SERVER['PHP_SELF']) != 'fight.php' && basename($_SERVER['PHP_SELF']) != 'fight.php')
            URL::to('fight.php');
    }

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
								
				<div class="col-12 text-center display-4">Szczelina</div>
				
				<div class="col-12 col-md-6" style="margin-top: 15px;">
                    <?php
                        
                        $riftEnemy = new RiftEnemy(1);
                        $riftEnemyStats = $riftEnemy->getStat();
                    
                        $_SESSION['hpBeforeRift'] = DatabaseManager::selectBySQL("SELECT statHp FROM users WHERE id=".$_SESSION['uid'])[0]['statHp'];
                        $_SESSION['enemyInfo']['enemyHp'] = $riftEnemyStats['hp'];
                        $_SESSION['enemyInfo']['enemyMaxHp'] = $riftEnemyStats['hp'];
                        $_SESSION['enemyInfo']['enemyArmor'] = $riftEnemyStats['armor'];
                        $_SESSION['enemyInfo']['enemyMaxArmor'] = $riftEnemyStats['armor'];
                        $_SESSION['enemyInfo']['enemyDamage'] = $riftEnemyStats['damage'];
                        $_SESSION['enemyInfo']['level'] = $riftEnemyStats['level'];
                        $_SESSION['riftEnemy'] = serialize($riftEnemy);
                        unset($riftEnemy);

                        echo "<h3>Twój akutalny rekord w szczelinie to: ".DatabaseManager::selectBySQL('SELECT riftLevel FROM users WHERE id='.$_SESSION['uid'])[0]['riftLevel']." !</h3><br>";

                        echo <<< END
                        <div class="text-center" style="margin-bottom: 35px;">
                        <div id="fight"></div>

                        <div class="btn-dark btn-lg" onclick="start()">Wejdz do szczeliny</div>
                        <div class="btn-dark btn-lg" onclick="location.href = 'index.php'">Uciekaj</div>

                        </div>

                        <script defer>

                            function start() {
                                $.ajax({
                                    url: "getEnemyStatsRift.php",
                                    method: "post",
                                    data: {
                                        co: "startFight"
                                    }
                                }).done((result) => {
                                    location.href = 'fightRift.php';
                                })  
                            }
                                document.addEventListener("DOMContentLoaded",() => {
                                const fight = document.querySelector("#fight");
                            })          
                        </script>
END;
                    
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
        function startRift() {
            $.ajax({
                url: "getEnemyStatRift.php",
                method: "post",
                data: {
                    rift: "1"
                }
            })
        }
    </script>

</body>
</html>