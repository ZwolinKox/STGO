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
                                    //Tu jest walka wiec zostawiam na pozniej
                                }
                                else if(Get::get('gdzie') == 'sklep')
                                {
                                    //Tutaj AJAX niestety musi być no bo to nie ma sensu robić 10000000 podstron,
                                    //wszystkie sklepy to bedzie musial byc AJAX i tyle xDDD


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

                                    echo '<div class="btn-dark btn-lg" id="horror">Horror (-10 Energii, -15 SłyszCoin, +0-2 Inteligencji)</div>';
                                    echo '<div class="btn-dark btn-lg" id="przygodowa">Przygodowa (-10 Energii, -15 SłyszCoin, +0-2 Inteligencji)</div>';
                                    echo '<div class="btn-dark btn-lg" id="naukowa">Naukowa (-10 Energii, -15 SłyszCoin, +0-2 Inteligencji)</div>';

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
                                        DatabaseManager::updateTable('users', ['slyszCoin' => 'SlyszCoin+100'], ['id' => $_SESSION['uid']]);
                                        echo '<h3 style="color: lightgreen;">Udało ci się okraść plecak! Zarobiłeś 100 Słysz Coinów!</h3>';
                                        echo '<div class="btn-dark btn-lg href" id="szkola.php">Wróc na korytarz!</div>';
                                    }
                                }
                                else if(Get::get('gdzie') == 'pietro')
                                {

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
                                            echo '<div class="btn-dark btn-lg" id="burgerslysz">SłyszBurger (-1 Siła, +1 MaxHP)</div>';
                                            echo '<div class="btn-dark btn-lg" id="bigslysz">BigSłysz (+1 Siła, -1 MaxHP)</div>';
                                            echo '<br><div class="btn-dark btn-lg href" id="szkola.php?gdzie=park">Wyjdz na dwór</div>';
                                        }
                                        else if(Get::get('miejsce') == 'aldi')
                                        {
                                            echo '<h3>Witaj w Aldi!</h3><br>';
                                            echo '<div class="btn-dark btn-lg" id="kamizelka">Kamizelka odblaskowa (Koszt: 500Słysz Coinów)</div>';
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

                                echo '<div class="btn-dark btn-lg href" id="szkola.php?gdzie=parter-szukaj">Przeszukaj parter </div>';
                                echo '<div class="btn-dark btn-lg href" id="szkola.php?gdzie=sklep">Sklepik szkolny </div>';
                                echo '<div class="btn-dark btn-lg href" id="szkola.php?gdzie=toaleta">Toaleta </div>';
                                echo '<div class="btn-dark btn-lg href" id="szkola.php?gdzie=biblioteka">Biblioteka </div>';
                                echo '<div class="btn-dark btn-lg href" id="szkola.php?gdzie=plecaki">Okradnij plecaki </div>';
                                echo '<div class="btn-dark btn-lg href" id="szkola.php?gdzie=pietro">Wejdz na wyższe piętro </div>';
                                echo '<div class="btn-dark btn-lg href" id="szkola.php?gdzie=park">Idz do parku </div>';
                                echo '<br><div class="btn-dark btn-lg href" id="szkola.php?gdzie=dom">Wróć do domu </div>';
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous" defer></script>
    <script>
        const jedyneczkaBtn = document.querySelector("#jedyneczka");
        const dwojeczkaBtn = document.querySelector("#dwojeczka");

        jedyneczkaBtn.addEventListener("click", function() {
            $.ajax({
                url: "ajax.php",
                method: "post",
                data: {
                    co: "jedyneczka"
                }
            })
        })

        dwojeczkaBtn.addEventListener("click", function() {
            $.ajax({
                url: "ajax.php",
                method: "post",
                data: {
                    co: "dwojeczka"
                }
            })
        })
    </script>

    <script>
        const horrorBtn = document.querySelector("#horror");
        const przygodowaBtn = document.querySelector("#przygodowa");
        const naukowaBtn = document.querySelector("#naukowa");

        horrorBtn.addEventListener("click", function() {
                    $.ajax({
                        url: "ajax.php",
                        method: "post",
                        data: {
                            co: "horror"
                        }
                    })
                })

                przygodowaBtn.addEventListener("click", function() {
                    $.ajax({
                        url: "ajax.php",
                        method: "post",
                        data: {
                            co: "przygodowa"
                        }
                    })
                })

                naukowaBtn.addEventListener("click", function() {
                    $.ajax({
                        url: "ajax.php",
                        method: "post",
                        data: {
                            co: "naukowa"
                        }
                    })
                })

    </script>

    <script>
        const burgerslyszBtn = document.querySelector("#burgerslysz");
        const bigslyszBtn = document.querySelector("#bigslysz");

        burgerslyszBtn.addEventListener("click", function() {
            $.ajax({
                url: "ajax.php",
                method: "post",
                data: {
                    co: "burgerslysz"
                }
            })
        })

        bigslyszBtn.addEventListener("click", function() {
            $.ajax({
                url: "ajax.php",
                method: "post",
                data: {
                    co: "bigslysz"
                }
            })
        })
    </script>

    <script>
        const hotdogBtn = document.querySelector("#hotdog");

        hotdogBtn.addEventListener("click", function() {
            $.ajax({
                url: "ajax.php",
                method: "post",
                data: {
                    co: "hotdog"
                }
            })
        })
    </script>

<script>
        const kamizelkaBtn = document.querySelector("#kamizelka");

        kamizelkaBtn.addEventListener("click", function() {
            $.ajax({
                url: "ajax.php",
                method: "post",
                data: {
                    co: "kamizelka"
                }
            })
        })
    </script>


</body>
</html>