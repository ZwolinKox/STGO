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
                            
                            echo '<h3>Depozyt klanowy posiada 10 miejsc!</h3>';
                            echo '<h3 style="color: red;" id="error"></h3>';
                            echo '<label style="margin-top: 15px;" for="playerItems"><h4>Twoje przedmioty</h4></label>';
                            echo '<select class="form-control" id="playerItems">';
                                
                            if(DatabaseManager::selectBySQL("SELECT eqSlotOne FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotOne'] != 0)
                            {
                                echo '<option value='.DatabaseManager::selectBySQL("SELECT eqSlotOne FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotOne'].'>'.EqManager::item(DatabaseManager::selectBySQL("SELECT eqSlotOne FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotOne'], 'name').'</option>';  
                            }
                            if(DatabaseManager::selectBySQL("SELECT eqSlotTwo FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotTwo'] != 0)
                            {
                                echo '<option value='.DatabaseManager::selectBySQL("SELECT eqSlotTwo FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotTwo'].'>'.EqManager::item(DatabaseManager::selectBySQL("SELECT eqSlotTwo FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotTwo'], 'name').'</option>';
                            }
                            if(DatabaseManager::selectBySQL("SELECT eqSlotThree FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotThree'] != 0)
                            {
                                echo '<option value='.DatabaseManager::selectBySQL("SELECT eqSlotThree FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotThree'].'>'.EqManager::item(DatabaseManager::selectBySQL("SELECT eqSlotThree FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotThree'], 'name').'</option>';
                            }
                            if(DatabaseManager::selectBySQL("SELECT eqSlotFour FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotFour'] != 0)
                            {
                                echo '<option value='.DatabaseManager::selectBySQL("SELECT eqSlotFour FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotFour'].'>'.EqManager::item(DatabaseManager::selectBySQL("SELECT eqSlotFour FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotFour'], 'name').'</option>';
                            }
                            if(DatabaseManager::selectBySQL("SELECT eqSlotFive FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotFive'] != 0)
                            {
                                echo '<option value='.DatabaseManager::selectBySQL("SELECT eqSlotFive FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotFive'].'>'.EqManager::item(DatabaseManager::selectBySQL("SELECT eqSlotFive FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotFive'], 'name').'</option>';
                            }
                            if(DatabaseManager::selectBySQL("SELECT eqSlotSix FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotSix'] != 0)
                            {
                                echo '<option value='.DatabaseManager::selectBySQL("SELECT eqSlotSix FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotSix'].'>'.EqManager::item(DatabaseManager::selectBySQL("SELECT eqSlotSix FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotSix'], 'name').'</option>';
                            }
                            if(DatabaseManager::selectBySQL("SELECT eqSlotSeven FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotSeven'] != 0)
                            {
                                echo '<option value='.DatabaseManager::selectBySQL("SELECT eqSlotSeven FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotSeven'].'>'.EqManager::item(DatabaseManager::selectBySQL("SELECT eqSlotSeven FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotSeven'], 'name').'</option>';
                            }
                            if(DatabaseManager::selectBySQL("SELECT eqSlotEight FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotEight'] != 0)
                            {
                                echo '<option value='.DatabaseManager::selectBySQL("SELECT eqSlotEight FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotEight'].'>'.EqManager::item(DatabaseManager::selectBySQL("SELECT eqSlotEight FROM users WHERE id=".$_SESSION['uid'])[0]['eqSlotEight'], 'name').'</option>';
                            }

                            echo '</select>';

                            echo '<div class="btn-dark btn-lg" style="margin-top: 35px;" onclick="sendItem()">Włóż przedmiot do depozytu</div>';
                            echo '<label style="margin-top: 15px;" for="guildItems"><h4>Depozyt klanowy</h4></label>';

                            echo '<select class="form-control" id="guildItems">';
                                
                            if(DatabaseManager::selectBySQL("SELECT guildBankSlotOne FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotOne'] != 0)
                            {
                                echo '<option value='.DatabaseManager::selectBySQL("SELECT guildBankSlotOne FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotOne'].'>'.EqManager::item(DatabaseManager::selectBySQL("SELECT guildBankSlotOne FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotOne'], 'name').'</option>';  
                            }
                            if(DatabaseManager::selectBySQL("SELECT guildBankSlotTwo FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotTwo'] != 0)
                            {
                                echo '<option value='.DatabaseManager::selectBySQL("SELECT guildBankSlotTwo FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotTwo'].'>'.EqManager::item(DatabaseManager::selectBySQL("SELECT guildBankSlotTwo FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotTwo'], 'name').'</option>';
                            }
                            if(DatabaseManager::selectBySQL("SELECT guildBankSlotThree FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotThree'] != 0)
                            {
                                echo '<option value='.DatabaseManager::selectBySQL("SELECT guildBankSlotThree FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotThree'].'>'.EqManager::item(DatabaseManager::selectBySQL("SELECT guildBankSlotThree FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotThree'], 'name').'</option>';
                            }
                            if(DatabaseManager::selectBySQL("SELECT guildBankSlotFour FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotFour'] != 0)
                            {
                                echo '<option value='.DatabaseManager::selectBySQL("SELECT guildBankSlotFour FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotFour'].'>'.EqManager::item(DatabaseManager::selectBySQL("SELECT guildBankSlotFour FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotFour'], 'name').'</option>';
                            }
                            if(DatabaseManager::selectBySQL("SELECT guildBankSlotFive FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotFive'] != 0)
                            {
                                echo '<option value='.DatabaseManager::selectBySQL("SELECT guildBankSlotFive FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotFive'].'>'.EqManager::item(DatabaseManager::selectBySQL("SELECT guildBankSlotFive FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotFive'], 'name').'</option>';
                            }
                            if(DatabaseManager::selectBySQL("SELECT guildBankSlotSix FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotSix'] != 0)
                            {
                                echo '<option value='.DatabaseManager::selectBySQL("SELECT guildBankSlotSix FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotSix'].'>'.EqManager::item(DatabaseManager::selectBySQL("SELECT guildBankSlotSix FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotSix'], 'name').'</option>';
                            }
                            if(DatabaseManager::selectBySQL("SELECT guildBankSlotSeven FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotSeven'] != 0)
                            {
                                echo '<option value='.DatabaseManager::selectBySQL("SELECT guildBankSlotSeven FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotSeven'].'>'.EqManager::item(DatabaseManager::selectBySQL("SELECT guildBankSlotSeven FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotSeven'], 'name').'</option>';
                            }
                            if(DatabaseManager::selectBySQL("SELECT guildBankSlotEight FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotEight'] != 0)
                            {
                                echo '<option value='.DatabaseManager::selectBySQL("SELECT guildBankSlotEight FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotEight'].'>'.EqManager::item(DatabaseManager::selectBySQL("SELECT guildBankSlotEight FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotEight'], 'name').'</option>';
                            }
                            if(DatabaseManager::selectBySQL("SELECT guildBankSlotNine FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotNine'] != 0)
                            {
                                echo '<option value='.DatabaseManager::selectBySQL("SELECT guildBankSlotNine FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotNine'].'>'.EqManager::item(DatabaseManager::selectBySQL("SELECT guildBankSlotNine FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotNine'], 'name').'</option>';
                            }
                            if(DatabaseManager::selectBySQL("SELECT guildBankSlotTen FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotTen'] != 0)
                            {
                                echo '<option value='.DatabaseManager::selectBySQL("SELECT guildBankSlotTen FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotTen'].'>'.EqManager::item(DatabaseManager::selectBySQL("SELECT guildBankSlotTen FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotTen'], 'name').'</option>';
                            }

                            echo '</select>';


                            echo '<div class="btn-dark btn-lg" style="margin-top: 35px;" onclick="getItem()">Wyjmij przedmiot z depozytu</div>';

                            

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

            function getItem() {

                const itemIdd = document.querySelector('#guildItems').value;

                $.ajax({
                    url: "ajax.php",
                    method: "post",
                    data: {
                        co: "getItemGuild",
                        itemId: itemIdd
                    }
                }).done((result) => {
                    if(result != "success")
                        document.querySelector('#error').innerHTML = result;
                        
                    parent.window.location.reload();
                })
            }

            
            function sendItem() {

                const itemIdd = document.querySelector('#playerItems').value;

                $.ajax({
                    url: "ajax.php",
                    method: "post",
                    data: {
                        co: "sendItemGuild",
                        itemId: itemIdd
                    }
                }).done((result) => {
                    if(result != "success")
                        document.querySelector('#error').innerHTML = result;

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