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
                            



                           if($areYouOwner)
                           {
                               
                            echo '
                            <div class="form-group" style="margin-top: 15px;">
                            <h3><label for="gangName" id="gangNameLabel">Nazwa: </label></h3>
                            <input type="text" class="form-control" id="gangName" name="gangName">
                            </div>
                            ';
                                echo '<div id="cerr"></div>';
                                echo '<div class="btn-dark btn-lg" onclick="newFriend()">Nowy sojusz</div>';
                                echo '<div class="btn-dark btn-lg" onclick="newEnemy()">Nowa wojna</div>';

                           }

                            echo '<div class="btn-dark btn-lg href" id="gangs.php">Wróć do strony gangu</div>';

                    $wynik = DatabaseManager::selectbySQL('SELECT * FROM guilddiplomacy WHERE guildOne="'.$guildName.'" OR guildTwo="'.$guildName.'"');
                    //$wynik = DatabaseManager::selectbySQL("SELECT * FROM guilds ORDER BY guildLevel DESC LIMIT 10");

                    if(is_array($wynik))
                    {
                        echo '<br><table class="table table-striped table-dark">
                                <thead>
                                <tr>
                                    <th scope="col">Nazwa gangu</th>
                                    <td scope="col">Założyciel</td>
                                    <td scope="col">Punkty gangu</td>
                                    <td scope="col">Poziom gangu</td>
                                    <td scope="col">Typ dyplomacji</td>
                                    
                                </tr>
                                <tbody>';
    
                        $check = count($wynik)-1;
    
                        for($i=count($wynik)-1; $i != -1; $i--)
                        {

                            if($wynik[abs($i-$check)]['guildOne'] == $guildName)
                                $otherGuildName = $wynik[abs($i-$check)]['guildTwo'];
                            else
                                $otherGuildName = $wynik[abs($i-$check)]['guildOne'];

                            $otherGuildInfo =  DatabaseManager::selectBySQL("SELECT * FROM guilds WHERE guildName='".$otherGuildName."'")[0];

                            $otherOwnerName = DatabaseManager::selectBySQL("SELECT username FROM users WHERE id=".$otherGuildInfo['guildOwner'])[0]['username'];
                            $count = abs($i - $check-1);       
                            $otherGuildPoints = $otherGuildInfo['guildPoints'];   
                            $otherGuildLevel= $otherGuildInfo['guildLevel'];   
                            $otherGuildMoney = $otherGuildInfo['guildBankSlyszCoin'];  
    
                        echo '
                                <tr>
                                    <th>'.$otherGuildName.'</th>
                                    <td><a style="color: lightgreen"  href="ksiazka.php?profile='.$otherOwnerName.'">'.$otherOwnerName.'</a></td>
                                    <td>'.$otherGuildPoints.'</td>
                                    <td>'.$otherGuildLevel.'</td>
                                    <td>'.$wynik[abs($i-$check)]['type'].'</td>
                                </tr>';
                        }
                        echo    '</tbody>
                                </table>';
                    }
                    else 
                        echo "<h3 style='margin-top: 25px;'>Brak stosunków dyplomatycznych z innymi gangami!</h3>";


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

            function newEnemy() {

                const gangNamee = document.querySelector('#gangName').value;

                $.ajax({
                    url: "ajax.php",
                    method: "post",
                    data: {
                        co: "newEnemyGang",
                        gangName: gangNamee
                    }
                }).done((result) => {
                    console.log(result);
                    if(result == "success")
                        document.querySelector('#cerr').innerHTML = '<h3 style="color: lightgreen">Akcja się powiodła!</h3>';
                    else
                        document.querySelector('#cerr').innerHTML = '<h3 style="color: red">' + result +'</h3>';

                    setTimeout(() => {
                        parent.window.location.reload();
                    }, '500');
                    
                })
            }

            
            function newFriend() {

                const gangNamee = document.querySelector('#gangName').value;

                $.ajax({
                    url: "ajax.php",
                    method: "post",
                    data: {
                        co: "newFriendGang",
                        gangName: gangNamee
                    }
                }).done((result) => {
                    console.log(result);
                    if(result == "success")
                        document.querySelector('#cerr').innerHTML = '<h3 style="color: lightgreen">Akcja się powiodła!</h3>';
                    else
                        document.querySelector('#cerr').innerHTML = '<h3 style="color: red">' + result +'</h3>';

                    setTimeout(() => {
                        parent.window.location.reload();
                    }, '500');
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