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
                            echo <<< END
                            <h3>Nie jesteś członkiem gangu!</h3>
                            <div class="btn-dark btn-lg href" id="newGang.php">Załóż gang</div>
                            <div class="btn-dark btn-lg href" id="gangInvites.php">Sprawdź zaproszenia do gangu</div>
                            <div class="btn-dark btn-lg href" id="index.php">Przestań się bawić w udawaną gangsterkę i wróc do domu</div>
END;
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


                            //print_r(Guild::getGuildMember($guildMemberTwo));

                            echo <<< END
                            <h3>Jesteś członkiem gangu: $guildName</h3>
END;

                            echo '<div class="btn-dark btn-lg " data-toggle="modal" data-target="#clanList">Lista członków gangu</div>';

                           if($areYouOwner)
                           {

                            echo '<div class="btn-dark btn-lg href" id="invite.php">Zaproś nowych ludzi</div>';
                            echo '<div class="btn-danger btn-lg" style="margin-top: 75px;" id="deleteGuild">Rozwiąż gang</div>';
                           }
                           else
                           {

                            echo '<div class="btn-danger btn-lg" style="margin-top: 75px;" id="leaveGuild" onclick="leaveGuild()">Opuść gang</div>';

                           }

                            echo '<div class="btn-dark btn-lg href" id="index.php">Przestań się bawić w udawaną gangsterkę i wróc do domu</div>';

                        }





                         echo <<< END
        
        <!-- Modal -->
        <div style="color: black;" class="modal fade" id="clanList" tabindex="-1" role="dialog" aria-labelledby="clanLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="clanLabel">Lista klanowiczy</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <div class="input-group mb-3">
              <div class="input-group-append">
              <div class="form-group">
              <select class="form-control" id="players">
END;
               
               echo '<option value="guildOwner">1)'.Guild::getGuildMemberStat($guildOwner, 'username').'  LVL: '.Guild::getGuildMemberStat($guildOwner, 'userLevel').'</option>';
               echo '<option value="guildMemberTwo">2)'.Guild::getGuildMemberStat($guildMemberTwo, 'username').'  LVL: '.Guild::getGuildMemberStat($guildMemberTwo, 'userLevel').'</option>';
               echo '<option value="guildMemberThree">3)'.Guild::getGuildMemberStat($guildMemberThree, 'username').'  LVL: '.Guild::getGuildMemberStat($guildMemberThree, 'userLevel').'</option>';
               echo '<option value="guildMemberFour">4)'.Guild::getGuildMemberStat($guildMemberFour, 'username').'  LVL: '.Guild::getGuildMemberStat($guildMemberFour, 'userLevel').'</option>';
               echo '<option value="guildMemberFive">5)'.Guild::getGuildMemberStat($guildMemberFive, 'username').'  LVL: '.Guild::getGuildMemberStat($guildMemberFive, 'userLevel').'</option>'; 
               echo '<option value="guildMemberSix">6)'.Guild::getGuildMemberStat($guildMemberSix, 'username').'  LVL: '.Guild::getGuildMemberStat($guildMemberSix, 'userLevel').'</option>'; 
               echo '<option value="guildMemberSeven">7)'.Guild::getGuildMemberStat($guildMemberSeven, 'username').'  LVL: '.Guild::getGuildMemberStat($guildMemberSeven, 'userLevel').'</option>';  
               echo '<option value="guildMemberEight">8)'.Guild::getGuildMemberStat($guildMemberEight, 'username').'  LVL: '.Guild::getGuildMemberStat($guildMemberEight, 'userLevel').'</option>';  
               echo '<option value="guildMemberNine">9)'.Guild::getGuildMemberStat($guildMemberNine, 'username').'  LVL: '.Guild::getGuildMemberStat($guildMemberNine, 'userLevel').'</option>';  
               echo '<option value="guildMemberTen">10)'.Guild::getGuildMemberStat($guildMemberTen, 'username').'  LVL: '.Guild::getGuildMemberStat($guildMemberTen, 'userLevel').'</option>';  
echo <<< END

              </select>
            </div>
              </div>
            </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
END;

        if($areYouOwner)
        {
            echo '<button id="deleteMember" type="button" class="btn btn-danger">Usuń klanowicza</button>';
            // TUTAJ SIĘ TO KIEDYŚ PRZYDAecho '<button id="saveEq" type="button" class="btn btn-primary">Zapisz zmiany</button>';
        }

echo <<< END
              </div>
            </div>
          </div>
        </div>
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
    
    <script>
        let deleteMember = document.querySelector("#deleteMember");

            deleteMember.addEventListener("click", function() {
                const memberNumber = document.querySelector("#players").value;
                console.log(memberNumber);
                    $.ajax({
                        url: "ajax.php",
                        method: "post",
                        data: {
                            co: "deleteGuildMember",
                            member: memberNumber
                        }
                    }).done((result) => {
                        location.reload();
                    })
                })

        let deleteGuild = document.querySelector("#deleteGuild");

        deleteGuild.addEventListener("click", function() {
            console.log('xxxx');
                $.ajax({
                    url: "ajax.php",
                    method: "post",
                    data: {
                        co: "deleteGuild"
                    }
                }).done((result) => {
                    console.log(result);
                    location.reload();
                })
            })

            //let leaveGuild = document.querySelector("#leaveGuild");


           /* leaveGuild.addEventListener("click", function() {
                console.log('w kocui');
               
            })*/


            function leaveGuild()
            {
                $.ajax({
                    url: "ajax.php",
                    method: "post",
                    data: {
                        co: "leaveGuild"
                    }
                }).done((result) => {
                    console.log(result);
                    location.reload();
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