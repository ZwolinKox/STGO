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

                    <?php

                        if(DatabaseManager::selectBySQL("SELECT dayWeek FROM users WHERE id=".$_SESSION['uid'])[0]['dayWeek'] > 5)
                        {
                            echo '<h3 style="color: red;">Nie możesz iść do szkoły w weekend!</h3><br>';
                            echo '<div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                        }
                        else if(DatabaseManager::selectBySQL("SELECT boolSchool FROM users WHERE id=".$_SESSION['uid'])[0]['boolSchool'] == true)
                        {
                            echo '<h3 style="color: red;">Byłeś już dziś w szkole!</h3><br>';
                            echo '<div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                        }
                        else if(DatabaseManager::selectBySQL("SELECT boolSchoolBan FROM users WHERE id=".$_SESSION['uid'])[0]['boolSchoolBan'] == true)
                        {
                            echo '<h3 style="color: red;">Zostałeś zawieszony!</h3><br>';
                            echo '<div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                        }
                        else
                        {
                            if(Get::exist('gdzie'))
                            {
                                if(Get::get('gdzie') == 'parter-szukaj')
                                {

                                    $enemyId = rand(1, 4);
                                    $enemyStats = DatabaseManager::selectBySQL("SELECT * FROM enemy WHERE id=$enemyId");
                                    $enemyInfo = $enemyStats[0]['name'].' Lvl: '.$enemyStats[0]['enemyLevel'];

                                    $_SESSION['enemyId'] = $enemyId;
                                    $_SESSION['enemyInfo'] = $enemyStats[0];
                                    $_SESSION['enemyInfo']['enemyMaxHp'] = $_SESSION['enemyInfo']['enemyHp'];
                                    $_SESSION['enemyInfo']['enemyMaxArmor'] = $_SESSION['enemyInfo']['enemyArmor'];
                                    
                                    echo <<< END
                                    <div class="text-center" style="margin-bottom: 35px;">

                                    <div id="poszukiwanie" class="display-4" style="margin-bottom: 35px; color: red;">Poszukiwanie przeciwników...</div>

                                    <div id="search" class="spinner-border" role="status" style="width: 9rem; height: 9rem;">
                                        <span class="sr-only">Loading...</span>
                                    </div>

                                    <div id="fight"></div>

                                    </div>

                                    <script defer>

                                        function start() {
                                            $.ajax({
                                                url: "getEnemyStats.php",
                                                method: "post",
                                                data: {
                                                    co: "startFight"
                                                }
                                            }).done((result) => {
                                                location.href = 'fight.php';
                                            })
                                        
                                            
                                        }

                                        document.addEventListener("DOMContentLoaded",() => {
                                            const poszukiwanie = document.querySelector("#poszukiwanie");
                                            const fight = document.querySelector("#fight");

                                            setTimeout(() => {
                                                poszukiwanie.style.color = "lightGreen";
                                                poszukiwanie.innerHTML = "Znaleziono przeciwnika! $enemyInfo";
                                                document.querySelector("#search").style.display = "none";
                                                fight.innerHTML = `<div class="btn-dark btn-lg" onclick="start()">Walcz</div>
                                                <div class="btn-dark btn-lg" onclick="location.href = 'szkola.php'">Uciekaj</div>`
                                            }, 1000)

                                        })
                                        
                                    </script>

END;
                                }
                                else if(Get::get('gdzie') == 'pietro1-szukaj')
                                {

                                    $enemyId = rand(5, 8);
                                    $enemyStats = DatabaseManager::selectBySQL("SELECT * FROM enemy WHERE id=$enemyId");
                                    $enemyInfo = $enemyStats[0]['name'].' Lvl: '.$enemyStats[0]['enemyLevel'];

                                    $_SESSION['enemyId'] = $enemyId;
                                    $_SESSION['enemyInfo'] = $enemyStats[0];
                                    $_SESSION['enemyInfo']['enemyMaxHp'] = $_SESSION['enemyInfo']['enemyHp'];
                                    $_SESSION['enemyInfo']['enemyMaxArmor'] = $_SESSION['enemyInfo']['enemyArmor'];
                                    
                                    echo <<< END
                                    <div class="text-center" style="margin-bottom: 35px;">

                                    <div id="poszukiwanie" class="display-4" style="margin-bottom: 35px; color: red;">Poszukiwanie przeciwników...</div>

                                    <div id="search" class="spinner-border" role="status" style="width: 9rem; height: 9rem;">
                                        <span class="sr-only">Loading...</span>
                                    </div>

                                    <div id="fight"></div>

                                    </div>

                                    <script defer>

                                        function start() {
                                            $.ajax({
                                                url: "getEnemyStats.php",
                                                method: "post",
                                                data: {
                                                    co: "startFight"
                                                }
                                            }).done((result) => {
                                                location.href = 'fight.php';
                                            })
                                        
                                            
                                        }

                                        document.addEventListener("DOMContentLoaded",() => {
                                            const poszukiwanie = document.querySelector("#poszukiwanie");
                                            const fight = document.querySelector("#fight");

                                            setTimeout(() => {
                                                poszukiwanie.style.color = "lightGreen";
                                                poszukiwanie.innerHTML = "Znaleziono przeciwnika! $enemyInfo";
                                                document.querySelector("#search").style.display = "none";
                                                fight.innerHTML = `<div class="btn-dark btn-lg" onclick="start()">Walcz</div>
                                                <div class="btn-dark btn-lg" onclick="location.href = 'szkola.php'">Uciekaj</div>`
                                            }, 1000)

                                        })
                                        
                                    </script>

END;
                                }
                                else if(Get::get('gdzie') == 'pietro2-szukaj')
                                {

                                    $enemyId = rand(9, 12);
                                    $enemyStats = DatabaseManager::selectBySQL("SELECT * FROM enemy WHERE id=$enemyId");
                                    $enemyInfo = $enemyStats[0]['name'].' Lvl: '.$enemyStats[0]['enemyLevel'];

                                    $_SESSION['enemyId'] = $enemyId;
                                    $_SESSION['enemyInfo'] = $enemyStats[0];
                                    $_SESSION['enemyInfo']['enemyMaxHp'] = $_SESSION['enemyInfo']['enemyHp'];
                                    $_SESSION['enemyInfo']['enemyMaxArmor'] = $_SESSION['enemyInfo']['enemyArmor'];

                                    
                                    echo <<< END
                                    <div class="text-center" style="margin-bottom: 35px;">

                                    <div id="poszukiwanie" class="display-4" style="margin-bottom: 35px; color: red;">Poszukiwanie przeciwników...</div>

                                    <div id="search" class="spinner-border" role="status" style="width: 9rem; height: 9rem;">
                                        <span class="sr-only">Loading...</span>
                                    </div>

                                    <div id="fight"></div>

                                    </div>

                                    <script defer>

                                        function start() {
                                            $.ajax({
                                                url: "getEnemyStats.php",
                                                method: "post",
                                                data: {
                                                    co: "startFight"
                                                }
                                            }).done((result) => {
                                                location.href = 'fight.php';
                                            })
                                        
                                            
                                        }

                                        document.addEventListener("DOMContentLoaded",() => {
                                            const poszukiwanie = document.querySelector("#poszukiwanie");
                                            const fight = document.querySelector("#fight");

                                            setTimeout(() => {
                                                poszukiwanie.style.color = "lightGreen";
                                                poszukiwanie.innerHTML = "Znaleziono przeciwnika! $enemyInfo";
                                                document.querySelector("#search").style.display = "none";
                                                fight.innerHTML = `<div class="btn-dark btn-lg" onclick="start()">Walcz</div>
                                                <div class="btn-dark btn-lg" onclick="location.href = 'szkola.php'">Uciekaj</div>`
                                            }, 1000)

                                        })
                                        
                                    </script>

END;
                                }
                                else if(Get::get('gdzie') == 'sklep')
                                {
                                    echo '<h3>Witaj, tutaj możesz kupić efekty wzacmiające trwające jeden dzień!</h3><br>';
                                    echo '<div class="btn-dark btn-lg" id="hamburger">Hamburger z sosem Arabskim (+25 siły na jeden dzień, koszt 50Słysz Coinów)</div>';
                                    echo '<div class="btn-dark btn-lg" id="tost">Tost z szynką (+25 inteligencjii na jeden dzień, koszt 50Słysz Coinów)</div>';
                                    echo '<div class="btn-dark btn-lg" id="kawa">Kawa z automatu (Przywraca 25Hp, koszt 50Słsz Coinów)</div>';
                                    echo '<br><div class="btn-dark btn-lg href" id="szkola.php">Wróc na korytarz!</div>';
                                }
                                else if(Get::get('gdzie') == 'toaleta')
                                {
                                    echo '<div class="btn-dark btn-lg" id="jedyneczka">Jedyneczka (-1Hp, +1Energia)</div>';
                                    echo '<div class="btn-dark btn-lg" id="dwojeczka">Dwojeczka (+1Hp, -1Energia)</div>';
                                    echo '<br><div class="btn-dark btn-lg href" id="szkola.php">Wróc na korytarz!</div>';
                                }
                                else if(Get::get('gdzie') == 'biblioteka')
                                {
                                    echo '<h3>Jaką książkę chcesz przeczytać?</h3>';

                                    echo '<div class="btn-dark btn-lg" id="horror">Horror (-10 Energii, -30 SłyszCoin, +0-2 Inteligencji)</div>';
                                    echo '<div class="btn-dark btn-lg" id="przygodowa">Przygodowa (-10 Energii, -30 SłyszCoin, +1 Inteligencji)</div>';
                                    echo '<div class="btn-dark btn-lg" id="naukowa">Naukowa (-30 Energii, -30 SłyszCoin, +2-4 Inteligencji)</div>';
                                    echo '<br><div class="btn-dark btn-lg href" id="szkola.php">Wróc na korytarz!</div>';
                                   
                                }
                                else if(Get::get('gdzie') == 'sala')
                                {
                                    echo '<div class="btn-dark btn-lg" id="rozgrzewka">Prowadź rozgrzewkę (-10 Energii, -30 SłyszCoin, +1 Siły)</div>';
                                    echo '<div class="btn-dark btn-lg" id="materac">Rób ćwiczenia na materacu (-30 Energii, -30 SłyszCoin, +3-4 Siły)</div>';
                                    echo '<br><div class="btn-dark btn-lg href" id="szkola.php">Wróc na korytarz!</div>';
                                }
                                else if(Get::get('gdzie') == 'plecaki')
                                {
                                    $rng = rand(1, 5);
                                    if($rng > 3)
                                    {
                                        echo '<h3 style="color: red;">Nie udało ci się okraść plecaka!</h3>';
                                        echo '<div class="btn-dark btn-lg href" id="szkola.php">Wróc na korytarz!</div>';
                                    }
                                    else if($rng == 3)
                                    {
                                        DatabaseManager::updateTable('users', ['boolSchoolBan' => 'true'], ['id' => $_SESSION['uid']]);
                                        echo '<h3 style="color: red;">Zostałeś przyłapany na kradzieży! Zostajesz zawieszony</h3>';
                                        echo '<div class="btn-dark btn-lg href" id="index.php">Wróc do domu!</div>'; 
                                    }
                                    else
                                    {
                                        $sc = rand(1, 15);
                                        DatabaseManager::updateTable('users', ['slyszCoin' => 'SlyszCoin+'.$sc], ['id' => $_SESSION['uid']]);
                                        echo "<h3 style='color: lightgreen;'>Udało ci się okraść plecak! Zarobiłeś $sc Słysz Coinów!</h3>";
                                        echo '<div class="btn-dark btn-lg href" id="szkola.php">Wróc na korytarz!</div>';
                                    }
                                }
                                else if(Get::get('gdzie') == 'park')
                                {
                                    if(rand(1, 100) < 60)
                                    {
                                        RandomEvent::Dresy();
                                    }

                                    if(Get::exist('miejsce'))
                                    {
                                        if(Get::get('miejsce') == 'mcdonald')
                                        {
                                            echo '<h3>Witaj w McDonalds! Mogę przyjąć twoje zamówienie?</h3><br>';
                                            echo '<div class="btn-dark btn-lg" id="burgerslysz">SłyszBurger (-1 Siła, +1 MaxHP 15SC)</div>';
                                            echo '<div class="btn-dark btn-lg" id="bigslysz">BigSłysz (+1 Siła, -1 MaxHP 15SC)</div>';
                                            echo '<br><div class="btn-dark btn-lg href" id="szkola.php?gdzie=park">Wyjdz na dwór</div>';
                                        }
                                        else if(Get::get('miejsce') == 'aldi')
                                        {
                                            echo '<h3>Witaj w Aldi!</h3><br>';
                                            echo '<div class="btn-dark btn-lg" id="kamizelka">Kamizelka odblaskowa (Koszt: 500Słysz Coinów)</div>';
                                            echo '<div class="btn-dark btn-lg" id="czesci">Części komputerowe (Koszt: xxxSłysz Coinów)</div>';
                                            echo '<br><div class="btn-dark btn-lg href" id="szkola.php?gdzie=park">Wyjdz na dwór</div>';
                                        }
                                        else if(Get::get('miejsce') == 'stacja')
                                        {
                                            echo '<h3>Witaj na stacji benzynowej! Co podać?</h3><br>';
                                            echo '<div class="btn-dark btn-lg" id="hotdog">Hot-Dog (Koszt 20 Słysz Coin, przywraca 10HP)</div>';
                                            echo '<br><div class="btn-dark btn-lg href" id="szkola.php?gdzie=park">Wyjdz na dwór</div>';
                                        }
                                        else if(Get::get('miejsce') == 'bieg')
                                        {
                                            echo '<h3>Hahahahahaha, nie!</h3>';
                                            echo '<br><div class="btn-dark btn-lg href" id="szkola.php?gdzie=park">Wyjdz na dwór</div>';
                                            
                                            ///EASTER EGG
                                            DatabaseManager::updateTable('users', ['achivementRun' => 'achivementRun+1'], ['id' => $_SESSION['uid']]);
                                            if(DatabaseManager::selectBySQL("SELECT achivementRun FROM users WHERE id=".$_SESSION['uid'])[0]['achivementRun'] > 1000)
                                            {
                                                echo '<h3>POBIEGŁEŚ!! SZYBKOOO!!!</h3>';
                                                DatabaseManager::updateTable('users', ['nickCol' => '6'], ['id' => $_SESSION['uid']]);
                                            }
                                        }
                                    }
                                    else
                                    {
                                        echo '<div class="btn-dark btn-lg href" id="szkola.php?gdzie=park&miejsce=mcdonald">Idź do McDonalds </div>';
                                        echo '<div class="btn-dark btn-lg href" id="szkola.php?gdzie=park&miejsce=aldi">Idź do Aldika </div>';
                                        echo '<div class="btn-dark btn-lg href" id="szkola.php?gdzie=park&miejsce=stacja">Idź na stację benzynową </div>';
                                        echo '<div class="btn-dark btn-lg href" id="szkola.php?gdzie=park&miejsce=bieg">Idź biegać 1000m </div>';
                                        echo '<br><div class="btn-dark btn-lg href" id="szkola.php">Wróc do szkoły</div>';
                                    }
                                }
                                else if(Get::get('gdzie') == 'dom')
                                {
                                    DatabaseManager::updateTable('users', ['boolSchool' => 'true'], ['id' => $_SESSION['uid']]);
                                    header('Location: index.php'); 
                                }
                            }
                            else
                            {
                                echo '<h3>Gdzie chcesz iść? Pamiętaj, że jak wyjdziesz ze szkoły to będziesz mógł wrócić dopiero jutro!</h3>';

                                echo '<div class="btn-dark btn-lg href" id="szkola.php?gdzie=parter-szukaj">Przeszukaj: Parter (Zalecany poziom: 1)</div>';
                                echo '<div class="btn-dark btn-lg href" id="szkola.php?gdzie=pietro1-szukaj">Przeszukaj: Pierwsze piętro (Zalecany poziom: 12)</div>';
                                echo '<div class="btn-dark btn-lg href" id="szkola.php?gdzie=pietro2-szukaj">Przeszukaj: Drugie piętro (Zalecany poziom: 22)</div>';
                                echo '<br><div class="btn-dark btn-lg href" id="szkola.php?gdzie=dom">Wróć do domu </div>';
                                echo '<br><div class="btn-dark btn-lg href" id="szkola.php?gdzie=sklep">Sklepik szkolny </div>';
                                echo '<div class="btn-dark btn-lg href" id="szkola.php?gdzie=toaleta">Toaleta </div>';
                                echo '<div class="btn-dark btn-lg href" id="szkola.php?gdzie=biblioteka">Biblioteka </div>';
                                echo '<div class="btn-dark btn-lg href" id="szkola.php?gdzie=sala">Sala gimnastyczna </div>';
                                echo '<div class="btn-dark btn-lg href" id="szkola.php?gdzie=plecaki">Okradnij plecaki </div>';
                                echo '<div class="btn-dark btn-lg href" id="szkola.php?gdzie=park">Idz do parku </div>';
                                echo '<div class="btn-dark btn-lg href" id="sklodowska.php">Wyrusz w niebezpieczne rewiry</div>';
                            }
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
        const jedyneczkaBtn = document.querySelector("#jedyneczka");
        const dwojeczkaBtn = document.querySelector("#dwojeczka");
        if(jedyneczkaBtn)
        {
                jedyneczkaBtn.addEventListener("click", function() {
                    $.ajax({
                        url: "ajax.php",
                        method: "post",
                        data: {
                            co: "jedyneczka"
                        }
                })
            })
        }
        if(dwojeczkaBtn)
        {
                dwojeczkaBtn.addEventListener("click", function() {
                    $.ajax({
                        url: "ajax.php",
                        method: "post",
                        data: {
                            co: "dwojeczka"
                        }
                    })
            })
        }
    </script>

    <script>
        const horrorBtn = document.querySelector("#horror");
        const przygodowaBtn = document.querySelector("#przygodowa");
        const naukowaBtn = document.querySelector("#naukowa");

        if(horrorBtn)
        {
                horrorBtn.addEventListener("click", function() {
                    $.ajax({
                        url: "ajax.php",
                        method: "post",
                        data: {
                            co: "horror"
                        }
                    })
                })
        }
        if(przygodowaBtn)
        {
                przygodowaBtn.addEventListener("click", function() {
                    $.ajax({
                        url: "ajax.php",
                        method: "post",
                        data: {
                            co: "przygodowa"
                        }
                    })
                })
        }
        if(naukowaBtn)
        {
                naukowaBtn.addEventListener("click", function() {
                    $.ajax({
                        url: "ajax.php",
                        method: "post",
                        data: {
                            co: "naukowa"
                        }
                    })
                })
        }
    </script>

    <script>
        const rozgrzewkaBtn = document.querySelector("#rozgrzewka");
        const materacBtn = document.querySelector("#materac");

        if(rozgrzewkaBtn)
        {
                rozgrzewkaBtn.addEventListener("click", function() {
                    $.ajax({
                        url: "ajax.php",
                        method: "post",
                        data: {
                            co: "rozgrzewka"
                        }
                    })
                })
        }
        if(materacBtn)
        {
                materacBtn.addEventListener("click", function() {
                    $.ajax({
                        url: "ajax.php",
                        method: "post",
                        data: {
                            co: "materac"
                        }
                    })
                })
        }
    </script>

    <script>
        const burgerslyszBtn = document.querySelector("#burgerslysz");
        const bigslyszBtn = document.querySelector("#bigslysz");

        if(burgerslyszBtn)
        {
                burgerslyszBtn.addEventListener("click", function() {
                    $.ajax({
                        url: "ajax.php",
                        method: "post",
                        data: {
                            co: "burgerslysz"
                        }
                    })
                })
        }
        if(bigslyszBtn)
        {
                bigslyszBtn.addEventListener("click", function() {
                    $.ajax({
                        url: "ajax.php",
                        method: "post",
                        data: {
                            co: "bigslysz"
                        }
                    })
                })
        }
    </script>

    <script>
        const hotdogBtn = document.querySelector("#hotdog");

        if(hotdogBtn)
        {
                hotdogBtn.addEventListener("click", function() {
                    $.ajax({
                        url: "ajax.php",
                        method: "post",
                        data: {
                            co: "hotdog"
                        }
                    })
                })
        }
    </script>

    <script>
        const kamizelkaBtn = document.querySelector("#kamizelka");

        if(kamizelkaBtn)
        {
                kamizelkaBtn.addEventListener("click", function() {
                    $.ajax({
                        url: "ajax.php",
                        method: "post",
                        data: {
                            co: "kamizelka"
                        }
                    })
                })
        }
    </script>

    <script>
        const czesciBtn = document.querySelector("#czesci");

        if(czesciBtn)
        {
                czesciBtn.addEventListener("click", function() {
                        $.ajax({
                            url: "ajax.php",
                            method: "post",
                            data: {
                                co: "czesci"
                            }
                        })
                    })
        }
    </script>

    <script>
        const hamburgerBtn = document.querySelector("#hamburger");
        const tostBtn = document.querySelector("#tost");
        const kawaBtn = document.querySelector("#kawa");

        if(hamburgerBtn)
        {
                hamburgerBtn.addEventListener("click", function() {
                    $.ajax({
                        url: "ajax.php",
                        method: "post",
                        data: {
                            co: "hamburger"
                        }
                    })
                })
        }
        if(tostBtn)
        {
                tostBtn.addEventListener("click", function() {
                    $.ajax({
                        url: "ajax.php",
                        method: "post",
                        data: {
                            co: "tost"
                        }
                    })
                })
        }
        if(kawaBtn)
        {
                kawaBtn.addEventListener("click", function() {
                    $.ajax({
                        url: "ajax.php",
                        method: "post",
                        data: {
                            co: "kawa"
                        }
                    })
                })
        }
    </script>


</body>
</html>