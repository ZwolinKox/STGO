<!DOCTYPE html>
<?php

    require_once('config.php');


    if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false)
        header('Location: index.php');

        if(isset($_SESSION['fight']) && $_SESSION['fight']) {
            if(basename($_SERVER['PHP_SELF']) != 'fight.php' && basename($_SERVER['PHP_SELF']) != 'fight.php')
                URL::to('fight.php');
        }



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
								
				<div class="col-12 text-center display-4">Szkoła</div>
				
				<div class="col-12 col-md-6" style="margin-top: 15px;">

                    <main>
                        <h3 style="margin-bottom: 25px;"  class="text-center" >Wyszukiwanie przeciwnika na równym poziomie... (Jak w paru minut nie wyszuka przeciwnika należy odświeżyć grę)</h3>
                        
                        <div class="text-center" style="margin-top: 35px; margin-bottom: 35px;">
                        <div id="search" class="spinner-border" role="status" style="width: 4rem; height: 4rem;">
                            <span class="sr-only">Loading...</span>
                        </div>
                        </div>

                        
                        <h4  class="text-center" >W kolejce: <span id="seconds" style="color: gold;">0</span> sekund</h4>
                        <div class="btn-dark btn-lg" onclick="location.reload()">Odśwież</div>
                        <div class="btn-dark btn-lg href" id="sklodowska.php">Wycofaj swoje słowa</div>
                    </main>
                    
                    <!-- <div class="attribution-block"><a href="http://dig.ccmixter.org/files/SiobhanD/57378">Unbury Your Heart</a> by Siobhan Dakay (c) copyright 2018 Licensed under a Creative Commons <a href="http://creativecommons.org/licenses/by/3.0/">Attribution (3.0)</a> license. Ft: Madam Snowflake</div> -->

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
    
    <?php
    
        $role = rand(1, 2);

        if($role == 2) {

            DatabaseManager::deleteFrom('pvpqueue', ['host' => $_SESSION['uid'], 'client' => $_SESSION['uid']], "OR");
            DatabaseManager::insertInto('pvpqueue', ['client' => $_SESSION['uid']]);

            echo <<< END
            <script>  
            console.log('client');
            setInterval(() => {
                $.ajax({
                    url: "ajaxFightManager.php",
                    method: "post",
                    data: {
                        co: "allAccept"
                    }
                }).done((result) => {
                    if(result == "yes") {
                        location.href = "pvp.php";
                    }

                });
                

                $.ajax({
                    url: "ajaxFightManager.php",
                    method: "post",
                    data: {
                        co: "client"
                    }
                }).done((result) => {
                    if(result != "no") {
                        result = JSON.parse(result);
                        if(result.time <= 0)
                            location.href = "sklodowska.php";
                        document.querySelector('main').innerHTML = "CLIENT<h2 style='color: lightgreen;'> Znaleziono przeciwnika! </h2> <br></br> <div class='btn-dark btn-lg href' onclick='clientAccept()'>Potwierdź</div> <br><br> <h3>Pozostało: <strong style='color: gold;'>"+result.time+"</strong> sekund</h3>"
                    }
                })
                
            }, '300')
            
            </script>
END;
        }

        elseif ($role == 1) {
            $_SESSION['enemyFound'] = false;
            DatabaseManager::deleteFrom('pvpqueue', ['host' => $_SESSION['uid'], 'client' => $_SESSION['uid']], "OR");
            echo <<< END
            <script>  
            console.log('host');
            setInterval(() => {

                $.ajax({
                    url: "ajaxFightManager.php",
                    method: "post",
                    data: {
                        co: "allAccept"
                    }
                }).done((result) => {
                    if(result == "yes") {
                        location.href = "pvp.php";
                    }

                });
                
                $.ajax({
                    url: "ajaxFightManager.php",
                    method: "post",
                    data: {
                        co: "host"
                    }
                }).done((result) => {
                    if(result != "no") {
                        result = JSON.parse(result);
                        if(result.time <= 0)
                            location.href = "sklodowska.php";

                        document.querySelector('main').innerHTML = "HOST <h2 style='color: lightgreen;'> Znaleziono przeciwnika! </h2> <br></br> <div class='btn-dark btn-lg href' onclick='hostAccept()'>Potwierdź</div> <br><br> <h3>Pozostało: <strong style='color: gold;'>"+result.time+"</strong> sekund</h3>"
                    }
                })
                
            }, '300')
            
            </script>
END;
        }
            
    ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>    <script src="https://code.jquery.com/jquery-3.3.1.min.js"integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous" defer></script>
    
    <script>

    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
            c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
            }
        }
        return "";
    }

        function clientAccept()
        {
            $.ajax({
                    url: "ajaxFightManager.php",
                    method: "post",
                    data: {
                        co: "clientAccept"
                    }
                })
        }

        function hostAccept()
        {
            $.ajax({
                    url: "ajaxFightManager.php",
                    method: "post",
                    data: {
                        co: "hostAccept"
                    }
                })
        }


            function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        document.addEventListener('DOMContentLoaded', () => {

            var audio = new Audio('http://ccmixter.org/content/JeffSpeed68/JeffSpeed68_-_Unbury_Your_Heart.mp3');
            audio.play();

            audio.currentTime = getCookie('musicTime');

            audio.onended = function() {
                document.cookie = "musicTime=0.1";
                audio.currentTime = 0;
            };

            document.querySelector('#search').style.color = getRandomColor();

            const seconds = document.querySelector('#seconds');
            setInterval(() => {
                seconds.innerHTML++;
                document.cookie = "musicTime="+audio.currentTime; 
            }, '1000');
        })
    


    </script>

</body>
</html>