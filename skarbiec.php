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
								
				<div class="col-12 text-center display-4">Gangi</div>
				
				<div class="col-12 col-md-6" style="margin-top: 15px;">
                        
                        <?php
                        $guildInfo;


                        if(DatabaseManager::selectBySQL("SELECT guildName FROM users WHERE id=".$_SESSION['uid'])[0]['guildName'] == "") {
                            URL::to('index.php');
                        }
                        else {
                            $guildName = DatabaseManager::selectBySQL("SELECT guildName FROM users WHERE id=".$_SESSION['uid'])[0]['guildName'];
                            $guildInfo =  DatabaseManager::selectBySQL("SELECT * FROM guilds WHERE guildName='".$guildName."'")[0];
                            $areYouOwner = false;

                            if(DatabaseManager::selectBySQL("SELECT guildOwner FROM guilds WHERE guildName='".$guildName."'")[0]['guildOwner'] == Session::get('uid'))
                                $areYouOwner = true;

                                
                            $guildMemberTwo	= $guildInfo['guildMemberTwo'];
                            $guildMemberThree =	$guildInfo['guildMemberThree'];
                            $guildMemberFour = $guildInfo['guildMemberFour'];
                            $guildMemberFive = $guildInfo['guildMemberFive'];
                            $guildMemberSix	= $guildInfo['guildMemberSix'];
                            $guildMemberSeven =	$guildInfo['guildMemberSeven'];
                            $guildMemberEight =	$guildInfo['guildMemberEight'];
                            $guildMemberNine =	$guildInfo['guildMemberNine'];
                            $guildMemberTen = $guildInfo['guildMemberTen'];
                            $guildOwner = $guildInfo['guildOwner'];
                            

                            echo "<h3>Słysz Coiny w skarbcu: <span style='color: gold;'>".$guildInfo['guildBankSlyszCoin']."</span></h3>";

                            echo '
                            <div class="form-group" style="margin-top: 15px;">
                            <h3><label for="goldValueLabel" id="goldValueLabel">Ilość sc: </label></h3>
                            <input type="text" class="form-control" id="goldValue" name="goldValue">
                            </div>
                            ';

                           if($areYouOwner)
                           {
                                echo '<div class="btn-dark btn-lg" onclick="getMoney()">Wypłać pieniądze</div>';
                           }

                            echo '<div class="btn-dark btn-lg" onclick="sendMoney()">Wpłać pieniądze</div>';

                            

                            echo '<div class="btn-dark btn-lg href" id="gangs.php">Wróć do strony gangu</div>';

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
    
    <script>

            function getMoney() {

                const scValue = document.querySelector('#goldValue').value;

                
            }

            
            function sendMoney() {

                const scValue = document.querySelector('#goldValue').value;

                $.ajax({
                    url: "ajax.php",
                    method: "post",
                    data: {
                        co: "sendMoneyGuild",
                        money: scValue
                    }
                }).done((result) => {
                    console.log(result);
                    parent.window.location.reload();
                })
            }

            
        
                    
    </script>
    
    <footer style="background-color: rgb(37, 37, 44); padding-top: -10px;" class="footer fixed-bottom text-center">
        Słysz Symulator 2018 &copy; Wszelkie prawa zastrzeżone
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>