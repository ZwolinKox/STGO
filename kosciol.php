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
								
				<div class="col-12 text-center display-4">Kościół</div>
				
				<div class="col-12 col-md-6" style="margin-top: 15px;">

                    <?php
                        if(DatabaseManager::selectBySQL("SELECT boolChurch FROM users WHERE id=".$_SESSION['uid'])[0]['boolChurch'])
                        {
                            echo '<h3 style="color: red;">W tym tygodniu już byłeś w kościele!</h3><br>';
                            echo '<div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                        }
                        else if (DatabaseManager::selectBySQL("SELECT dayWeek FROM users WHERE id=".$_SESSION['uid'])[0]['dayWeek'] != 7) 
                        {
                            echo '<h3 style="color: red;">Do kościoła możesz iść tylko w niedzielę!</h3><br>';
                            echo '<div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                        }
                        else
                        {
                            if(Get::exist('co'))
                            {
                                if(Get::get('co') == 'ofiara')
                                {
                                    if(DatabaseManager::selectBySQL("SELECT slyszCoin FROM users WHERE id=".$_SESSION['uid'])[0]['slyszCoin'] < 1)
                                    {
                                        echo '<h3 style="color: red;">Nie masz tyle Słysz Coinów!</h3><br>';
                                        echo '<div class="btn-dark btn-lg href" id="kosciol.php">Wybierz inną czynność </div>';
                                        echo '<div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                    }
                                    else
                                    {
                                        DatabaseManager::updateTable('users', ['userEnergy' => '100', 'slyszCoin' => 'slyszCoin-1'], ['id' => $_SESSION['uid']]);
                                        echo '<h3 style="color: green;">Twoja energia została odnowiona!</h3>';
                                        $rng = rand(1,3);
                                        switch($rng)
                                        {
                                            case 1:
                                            {
                                                DatabaseManager::updateTable('users', ['statIntelect' => 'statIntelect+1'], ['id' => $_SESSION['uid']]);
                                                echo '<h3 style="color: green;">Twoja inteligencja wzrosła o 1!</h3>';
                                            }break;
                                            case 2:
                                            {
                                                DatabaseManager::updateTable('users', ['maxHp' => 'maxHp+1'], ['id' => $_SESSION['uid']]);
                                                echo '<h3 style="color: green;">Twoja maksymalna liczba punktów zdrowia wzrosła o 1!</h3>';
                                            }break;
                                            case 3:
                                            {
                                                DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin+1'], ['id' => $_SESSION['uid']]);
                                                echo '<h3 style="color: green;">Znalazłes w kieszeni jeszcze jednego Słysz Coina!</h3>';
                                            }break;
                                        }

                                        DatabaseManager::updateTable('users', ['boolChurch' => 'true'], ['id' => $_SESSION['uid']]);
                                        unset($rng);

                                        echo '<br><div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                        
                                    }
                                }
                                else if(Get::get('co') == 'kielich')
                                {
                                    $rng = rand(1,2);
                                    switch($rng)
                                    {
                                        case 1:
                                        {
                                            $gral = rand(1,1000);
                                            if($gral == 23)
                                            {
                                                // ACZIFMENT ZA GRAL, TRZEBA DO BAZY DODAC I TRZEBA OGÓŁEM NAPISAĆ CO SIĘ STANIE XD
                                            }
                                            else
                                            {
                                                DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin+100'], ['id' => $_SESSION['uid']]);
                                                echo '<h3 style="color: green;">Ksiądz był zadowolony, zdobyłeś 100 Słysz Coinów!</h3><br>';
                                            }
                                        }break;
                                        case 2:
                                        {
                                            echo '<h3 style="color: red;">Ksiądz nie był zadowolony, musisz wyjść z kośioła!</h3><br>';
                                        }break;
                                    }
                                    
                                    DatabaseManager::updateTable('users', ['boolChurch' => 'true'], ['id' => $_SESSION['uid']]);
                                    unset($rng);
                                    if(isset($gral))
                                    {
                                        unset($gral);
                                    }

                                    echo '<br><div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';

                                }
                                else if(Get::get('co') == 'ministrant')
                                {
                                    $rng = rand(1,2);
                                    switch($rng)
                                    {
                                        case 1:
                                        {
                                            DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin+40'], ['id' => $_SESSION['uid']]);
                                            echo '<h3 style="color: green;">Udało ci się pobić ministrantów! Zarobiłeś 40 Słysz Coinów z kolędy!</h3>';
                                        }break;
                                        case 2:
                                        {
                                            echo '<h3 style="color: red;"> Zostałeś pobity i wyrzucony z kościoła!</h3>';
                                            // TUTAJ TRZEBA DODAC ZE TRACISZ HP
                                        }break;
                                    }

                                    DatabaseManager::updateTable('users', ['boolChurch' => 'true'], ['id' => $_SESSION['uid']]);
                                    unset($rng);

                                    echo '<br><div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                }
                                else if(Get::get('co') == 'piesn')
                                {
                                    //Piesn to jest duzo klikania i to moze byc takie meeh w php
                                    //sam nie wierze w to co mówie ale jakby tu użyć jakiegos JS? xD

                                    //TU BEDZIE KOLEJNY ACZIFMENT
                                }
                                else if(Get::get('co') == 'kazanie')
                                {
                                    if(Get::exist('jakie'))
                                    {
                                        if(Get::get('jakie') == 'pierwsze')
                                        {
                                            echo '<h3>Twoje kazanie brzmiało następująco:';
                                            echo '<p style="text-align: justify;">
                                            Drodzy bracia i siostry, 
                                            Pomimo tego co wpaja nam "nauka" od setek lat trzeba ujrzec swiatlo prawdy.. 
                                            Otoz Ziemia nie jest okragla, tak jak wam tak wmawiaja naukowcy i rzad. 
                                            Od wiekow ludzie wiedzieli, ze jest plaska. 
                                            Dzisiaj malo kto zna prawde, 
                                            dlatego przybywam do was, aby was oswiecic.
                                            Wytlumaczcie mi moi drodzy, jak to jest. 
                                            Przeciez jakby ziemia byla kula, to oceany by po niej splywaly! 
                                            Nie przekonalem was? To posluchajcie tego!
                                            Samoloty nie mogą latać po kulistej Ziemi, gdyż ona się obraca, a każde lądowanie skończyłoby się katastrofą. 
                                            I co wy na to "naukowcy"?
                                            Na koniec chcialbym tylko prosic o wybaczenie dla tych, którzy szerzą te kłamstwa..
                                            </p><br>';
                                            $rng = rand(1,2);
                                            switch($rng)
                                            {
                                                case 1:
                                                {
                                                    $prize = rand(1,3);
                                                    switch($prize)
                                                    {
                                                        case 1: DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin+60'], ['id' => $_SESSION['uid']]); break;
                                                        case 2: DatabaseManager::updateTable('users', ['maxHp' => 'maxHp+10'], ['id' => $_SESSION['uid']]); break;
                                                        case 3: DatabaseManager::updateTable('users', ['statIntelect' => 'statIntelect+20'], ['id' => $_SESSION['uid']]); break;
                                                    }
                                                    
                                                    echo '<h3 style="color: green;">Ludzie byli zadowoleni! Otrzymałeś nagrodę!</h3>';
                                                    unset($prize);
                                                    
                                                }break;
                                                case 2:
                                                {
                                                    $penalty = rand(1,2);
                                                    switch($penalty)
                                                    {
                                                        case 1: DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-40'], ['id' => $_SESSION['uid']]); break;
                                                        case 2: DatabaseManager::updateTable('users', ['slyszCoin' => 'maxHp-10'], ['id' => $_SESSION['uid']]); break;
                                                    }

                                                    echo '<h3 style="color: red;">Ludzie nie byli zadowoleni! Zostałeś ukarany!</h3>';
                                                    unset($penalty);
                                                }break;
                                            }

                                            DatabaseManager::updateTable('users', ['boolChurch' => 'true'], ['id' => $_SESSION['uid']]);
                                            unset($rng);

                                            echo '<br><div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                            
                                        }
                                        else if(Get::get('jakie') == 'drugie')
                                        {
                                            echo '<h3>Twoje kazanie brzmiało następująco:';
                                            echo '<p style="text-align: justify;">
                                            Drodzy bracia i siostry
                                            Jak pewnie myslicie, Adolf Hitler byl czlowiekiem
                                            Jednakze byl genetycznie modyfikowanyn delfinem!
                                            Myslicie, ze to absurd?
                                            Nie powiedzialbym
                                            Adolf - Imie
                                            A dolphin - delfin
                                            Adolfin..
                                            To nie przypadek
                                            Ta cala wiedze mam z wiarygodnego zrodla, kwejk
                                            </p><br>';
                                            $rng = rand(1,2);
                                            switch($rng)
                                            {
                                                case 1:
                                                {
                                                    $prize = rand(1,3);
                                                    switch($prize)
                                                    {
                                                        case 1: DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin+60'], ['id' => $_SESSION['uid']]); break;
                                                        case 2: DatabaseManager::updateTable('users', ['maxHp' => 'maxHp+10'], ['id' => $_SESSION['uid']]); break;
                                                        case 3: DatabaseManager::updateTable('users', ['statIntelect' => 'statIntelect+20'], ['id' => $_SESSION['uid']]); break;
                                                    }
                                                    
                                                    echo '<h3 style="color: green;">Ludzie byli zadowoleni! Otrzymałeś nagrodę!</h3>';
                                                    unset($prize);
                                                    
                                                }break;
                                                case 2:
                                                {
                                                    $penalty = rand(1,2);
                                                    switch($penalty)
                                                    {
                                                        case 1: DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-40'], ['id' => $_SESSION['uid']]); break;
                                                        case 2: DatabaseManager::updateTable('users', ['slyszCoin' => 'maxHp-10'], ['id' => $_SESSION['uid']]); break;
                                                    }

                                                    echo '<h3 style="color: red;">Ludzie nie byli zadowoleni! Zostałeś ukarany!</h3>';
                                                    unset($penalty);
                                                }break;
                                            }

                                            DatabaseManager::updateTable('users', ['boolChurch' => 'true'], ['id' => $_SESSION['uid']]);
                                            unset($rng);

                                            echo '<br><div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                            
                                        }
                                        else if(Get::get('jakie') == 'trzecie')
                                        {
                                            echo '<h3>Twoje kazanie brzmiało następująco:';
                                            echo '<p style="text-align: justify;">
                                            Drodzy bracia i siostry
                                            Jak dobrze wiecie, coraz popularniejsze sa w internetach tzw czalendze
                                            Wykonywane sa zarowno przez gwiazdy, jak i zwyklych ludzi
                                            Jednakze jeden z nich, nie jest zwykla zabawa
                                            Mam tutaj na mysli Ice Bucket Challenge
                                            Pewnie zyjecie w przekonaniu, ze to zabawa charytatywna
                                            Ktora przerodzila sie w forme rozrywki?
                                            W zadnym wypadku!
                                            Diabel tkwi w szczegolach
                                            W rzeczywistosci jest to chrzest satanistyczny
                                            Jezeli widzicie, ze wasze dziecko wykonuje podobne praktyki, mozecie zglosic sie do egzorcysty
                                            </p><br>';
                                            $rng = rand(1,2);
                                            switch($rng)
                                            {
                                                case 1:
                                                {
                                                    $prize = rand(1,3);
                                                    switch($prize)
                                                    {
                                                        case 1: DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin+60'], ['id' => $_SESSION['uid']]); break;
                                                        case 2: DatabaseManager::updateTable('users', ['maxHp' => 'maxHp+10'], ['id' => $_SESSION['uid']]); break;
                                                        case 3: DatabaseManager::updateTable('users', ['statIntelect' => 'statIntelect+20'], ['id' => $_SESSION['uid']]); break;
                                                    }
                                                    
                                                    echo '<h3 style="color: green;">Ludzie byli zadowoleni! Otrzymałeś nagrodę!</h3>';
                                                    unset($prize);
                                                    
                                                }break;
                                                case 2:
                                                {
                                                    $penalty = rand(1,2);
                                                    switch($penalty)
                                                    {
                                                        case 1: DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-40'], ['id' => $_SESSION['uid']]); break;
                                                        case 2: DatabaseManager::updateTable('users', ['slyszCoin' => 'maxHp-10'], ['id' => $_SESSION['uid']]); break;
                                                    }

                                                    echo '<h3 style="color: red;">Ludzie nie byli zadowoleni! Zostałeś ukarany!</h3>';
                                                    unset($penalty);
                                                }break;
                                            }

                                            DatabaseManager::updateTable('users', ['boolChurch' => 'true'], ['id' => $_SESSION['uid']]);
                                            unset($rng);

                                            echo '<br><div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                            
                                        }
                                        else if(Get::get('jakie') == 'czwarte')
                                        {
                                            echo '<h3>Twoje kazanie brzmiało następująco:';
                                            echo '<p style="text-align: justify;">
                                            Drodzy bracia i siostry
                                            Na pewno wierzycie w podzial swiata, jaki jest wam pokazywany w szkolach
                                            Jednak jest to tylko propaganda miedzynarodowa
                                            Prawda jest zupelnie inna!
                                            Otoz prawda ejst inna
                                            Wszechswiat zlozony jest ze stref
                                            My zyjemy w strefie zielonej, a istnieja jeszcze takie jak czarna lub zolta!
                                            W dodatku czarna dziura moze wychodzic jako bialy karzel
                                            Tego nie wolno lekcewazyc
                                            Caly wszechswiat opiera sie na czestotliwosciach, najlepsza to 432 Hz..
                                            </p><br>';
                                            $rng = rand(1,2);
                                            switch($rng)
                                            {
                                                case 1:
                                                {
                                                    $prize = rand(1,3);
                                                    switch($prize)
                                                    {
                                                        case 1: DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin+60'], ['id' => $_SESSION['uid']]); break;
                                                        case 2: DatabaseManager::updateTable('users', ['maxHp' => 'maxHp+10'], ['id' => $_SESSION['uid']]); break;
                                                        case 3: DatabaseManager::updateTable('users', ['statIntelect' => 'statIntelect+20'], ['id' => $_SESSION['uid']]); break;
                                                    }
                                                    
                                                    echo '<h3 style="color: green;">Ludzie byli zadowoleni! Otrzymałeś nagrodę!</h3>';
                                                    unset($prize);
                                                    
                                                }break;
                                                case 2:
                                                {
                                                    $penalty = rand(1,2);
                                                    switch($penalty)
                                                    {
                                                        case 1: DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-40'], ['id' => $_SESSION['uid']]); break;
                                                        case 2: DatabaseManager::updateTable('users', ['slyszCoin' => 'maxHp-10'], ['id' => $_SESSION['uid']]); break;
                                                    }

                                                    echo '<h3 style="color: red;">Ludzie nie byli zadowoleni! Zostałeś ukarany!</h3>';
                                                    unset($penalty);
                                                }break;
                                            }

                                            DatabaseManager::updateTable('users', ['boolChurch' => 'true'], ['id' => $_SESSION['uid']]);
                                            unset($rng);

                                            echo '<br><div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                            
                                        }
                                        else if(Get::get('jakie') == "piate")
                                        {
                                            echo '<h3>Twoje kazanie brzmiało następująco:';
                                            echo '<p style="text-align: justify;">
                                            Jak pewnie dobrze wiecie... (Zostałes wyrzucony za zajmowanie ambony!)
                                            </p><br>';
                                            
                                            DatabaseManager::updateTable('users', ['boolChurch' => 'true'], ['id' => $_SESSION['uid']]);
                                            echo '<br><div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';

                                        }
                                    }
                                    else
                                    {
                                        echo '<h3>Które kazanie chcesz opowiedzieć?</h3><br>';
                                        echo '<div class="btn-dark btn-lg href" id="kosciol.php?co=kazanie&jakie=pierwsze">Kazanie pierwsze</div>';
                                        echo '<div class="btn-dark btn-lg href" id="kosciol.php?co=kazanie&jakie=drugie">Kazanie drugie</div>';
                                        echo '<div class="btn-dark btn-lg href" id="kosciol.php?co=kazanie&jakie=trzecie">Kazanie trzecie</div>';
                                        echo '<div class="btn-dark btn-lg href" id="kosciol.php?co=kazanie&jakie=czwarte">Kazanie czwarte</div>';
                                        echo '<div class="btn-dark btn-lg href" id="kosciol.php?co=kazanie&jakie=piate">Kazanie piąte</div>';
                                    }
                                }
                                else if(Get::get('co') == 'koszyk')
                                {
                                    if(rand(1,100) > 20)
                                    {
                                        if(rand(1,100) > 50)
                                        {
                                            DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin+80'], ['id' => $_SESSION['uid']]);
                                            echo '<h3 style="color: green;">Udało ci się ukraść pieniądze z koszyczka, nikt tego nie zauważył!</h3>';
                                        }
                                        else
                                        {
                                            echo '<h3 style="color: red;">Udało ci się ukraść pieniądze, ale kościelny to zauważył i musiałeś oddać pieniądze!</h3>';
                                        }
                                    }
                                    else
                                    {
                                        echo '<h3 style="color: red;">Koszyczek był pusty!</h3>';
                                    }

                                    DatabaseManager::updateTable('users', ['boolChurch' => 'true'], ['id' => $_SESSION['uid']]);
                                    echo '<br><div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                    
                                }
                            }
                            else
                            {
                                echo '<div class="btn-dark btn-lg href" id="kosciol.php?co=ofiara">Daj na ofiarę (Koszt to 1 Słysz Coin)</div>';
                                echo '<div class="btn-dark btn-lg href" id="kosciol.php?co=kielich">Napij się z kielicha</div>';
                                echo '<div class="btn-dark btn-lg href" id="kosciol.php?co=ministrant">Zaczep ministrantów</div>';
                                echo '<div class="btn-dark btn-lg href" id="kosciol.php?co=piesn">Zaśpiewaj pieśń</div>';
                                echo '<div class="btn-dark btn-lg href" id="kosciol.php?co=kazanie">Powiedz kazanie</div>';
                                echo '<div class="btn-dark btn-lg href" id="kosciol.php?co=koszyk">Okradnij koszyk</div>';
                                echo '<br><div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                            }
                        }

                    ?>

                </div>
		
	
                <div class="col-12 col-md-6 " style="margin-top: 30px">

                    <!-- Uzupełnij po bazy danych! -->

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
	

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>