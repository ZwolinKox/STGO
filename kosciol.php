<!DOCTYPE html>
<?php

    require_once('config.php');

    CheckUrl::check();

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
                                    if(Action::getCoins() < 1)
                                    {
                                        echo '<h3 style="color: red;">Nie masz tyle Słysz Coinów!</h3><br>';
                                        echo '<div class="btn-dark btn-lg href" id="kosciol.php">Wybierz inną czynność </div>';
                                        echo '<div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                    }
                                    else
                                    {
                                        Action::setEnergy(100);
                                        Action::delCoin(1);
                                        echo '<h3 style="color: lightgreen;">Twoja energia została odnowiona!</h3>';
                                        $rng = rand(1,3);
                                        switch($rng)
                                        {
                                            case 1:
                                            {
                                                Action::addIntelect(1);
                                                echo '<h3 style="color: lightgreen;">Twoja inteligencja wzrosła o 1!</h3>';
                                            }break;
                                            case 2:
                                            {
                                                Action::addMaxHp(1);
                                                echo '<h3 style="color: lightgreen;">Twoja maksymalna liczba punktów zdrowia wzrosła o 1!</h3>';
                                            }break;
                                            case 3:
                                            {
                                                Action::addCoin(1);
                                                echo '<h3 style="color: lightgreen;">Znalazłes w kieszeni jeszcze jednego Słysz Coina!</h3>';
                                            }break;
                                        }

                                        DatabaseManager::updateTable('users', ['boolChurch' => 'true'], ['id' => $_SESSION['uid']]);
                                        unset($rng);

                                        echo '<br><div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                        
                                    }
                                }
                                else if(Get::get('co') == 'kielich')
                                {
                                    $rng = rand(1,100);
                                    
                                    if($rng != 1)
                                        $rng = 2;
                                    
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
                                                Action::addCoin(100);
                                                echo '<h3 style="color: lightgreen;">Ksiądz był zadowolony, zdobyłeś 100 Słysz Coinów!</h3><br>';
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
                                            Action::addCoin(40);
                                            echo '<h3 style="color: lightgreen;">Udało ci się pobić ministrantów! Zarobiłeś 40 Słysz Coinów z kolędy!</h3>';
                                        }break;
                                        case 2:
                                        {
                                            Action::delHp(25);
                                            echo '<h3 style="color: red;"> Zostałeś pobity i wyrzucony z kościoła!</h3>';
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


                                    echo'
                                                <h3 style="color: lightgreen;" id="songGit"></h3>
                                                    <br><select class="form-control" id="song1">
                                                        <option value="1">Tu naraze jest ściernisko</option>
                                                        <option value="2">Pole, pole, łyse pole</option>
                                                        <option value="3">Pomalutku, bez pośpiechu</option>
                                                        <option value="4">wszystko zrobię sam</option>
                                                        <option value="5">ale mam już plan</option>
                                                    </select><br>
                                                
                                                    <select class="form-control" id="song2">
                                                        <option value="1">Tu naraze jest ściernisko</option>
                                                        <option value="2">Pole, pole, łyse pole</option>
                                                        <option value="3">Pomalutku, bez pośpiechu</option>
                                                        <option value="4">wszystko zrobię sam</option>
                                                        <option value="5">ale mam już plan</option>
                                                    </select><br>
                                                
                                                    <select class="form-control" id="song3"id="song1">
                                                        <option value="1">Tu naraze jest ściernisko</option>
                                                        <option value="2">Pole, pole, łyse pole</option>
                                                        <option value="3">Pomalutku, bez pośpiechu</option>
                                                        <option value="4">wszystko zrobię sam</option>
                                                        <option value="5">ale mam już plan</option>
                                                    </select><br>
                                                
                                                    <select class="form-control" id="song4">
                                                        <option value="1">Tu naraze jest ściernisko</option>
                                                        <option value="2">Pole, pole, łyse pole</option>
                                                        <option value="3">Pomalutku, bez pośpiechu</option>
                                                        <option value="4">wszystko zrobię sam</option>
                                                        <option value="5">ale mam już plan</option>
                                                    </select><br>';

                                    echo '<br><div class="btn-dark btn-lg" id="goSong">Śpiewaj!</div>';


                                }
                                else if(Get::get('co') == 'kazanie')
                                {
                                    if(Get::exist('jakie'))
                                    {
                                        if(rand(1, 20) == 5)
                                        {
                                            DatabaseManager::updateTable('users', ['boolChurch' => 'true'], ['id' => $_SESSION['uid']]);
                                            $_SESSION['papa'] = true;
                                            echo '<h3>Od słów twojej prawdy objawił Ci się papież!: </h3>';
                                            echo '<audio autoplay controls>
                                            <source src="http://goleniow.net.pl/request.php?6" type="audio/mp3">
                                          </audio>';
                                            
                                          echo '<script type="text/javascript" src="http://bajery.net/js/sp.js?img=http%3A%2F%2F28.csd.pl%2Fsite%2Fak.otrebusy%2Fak-graphs%2Fprodukty%2Fciastka%2Fkremowka.png&timer=40&num=10"></script>';
                                        
                                        echo '<br><div class="btn-dark btn-lg" onclick="rozmowa()">Rozmawiaj z nim</div>';
                                        echo '<div class="btn-dark btn-lg" onclick="szkalowanie()">Szkaluj go</div>';


                                        echo '<div id="papamessage"></div>';


                                        }

                                        elseif(Get::get('jakie') == 'pierwsze')
                                        {
                                            echo '<h3>Twoje kazanie brzmiało następująco:';
                                            echo '<p style="text-align: justify;">
                                           Na początku nie było nic. Następnie pojawił się Piszczan. Piszczan zaczął walić piszczana. Tak powstała ziemia. Następnie Piszczan stwierdził, że to jest dobre. Zaczął ponownie walić piszczana. Następnie oddał mocz, uznając że w ziemi musi coś płynąć. Tak właśnie wypełnił ziemię Harnasiem. Piszczan stwierdził, że to jest dobre. Piszczan po raz 3 ponowił walić piszczana. Wtedy pierwszy raz wypowiedziano słowa „Masno Ni”. W ten sposób powstali ludzie, zwierzęta oraz wieloryby. Piszczan postanowił stworzyć kogoś równego sobie, kogoś kto mu dorówna, kogoś kto będzie z nim rapował. Zaczął walić piszczana i tak powstał Hulbój. Piszczan nadał sobie tytuł Lil. Od tego momentu był to Lil Piszczan. Hulbój nadał sobie tytuł Young. Od tamtego momentu w świecie istniały 2 najsilniejsze istoty we wszechświecie, Young Hulbów i Lil Piszczan. Jednak Piszczan zaczął się nudzić, więc postanowił dać ludziom inteligencję. Zaczęli tworzyć cywilizacje, jedna szczególnie wdała się w łaski Piszczana, naród żydowski. Na wodza tego narodu wybrał ówczesną najpotężniejszą istotę na ziemi, Mojżesza. To on na górze Sohan otrzymał od Lil Piszczana jego 2 płyty, na pierwszej skierowanej do samego Piszczana były 3 kawałki, jeden z Hulbójem na feacie, a na drugiej płycie znajdowało się 7 utworów skierowanych do ludzi. Jednak Mojżesz stwierdził, że rapowanie jest również dla niego, jednak nie mówił o to Lil Piszczanowi. Lil Piszczan następnie postanowił zrobić dla siebie konkurencję muzyczną, tak powstało NBG, którego siedziba mieściła się w Nędzy.
                                            </p><br>';
                                            $rng = rand(1,2);
                                            switch($rng)
                                            {
                                                case 1:
                                                {
                                                    $prize = rand(1,3);
                                                    switch($prize)
                                                    {
                                                        case 1: Action::addCoin(60); break;
                                                        case 2: Action::addMaxHp(10); break;
                                                        case 3: Action::addIntelect(5); break;
                                                    }
                                                    
                                                    echo '<h3 style="color: lightgreen;">Ludzie byli zadowoleni! Otrzymałeś nagrodę!</h3>';
                                                    unset($prize);
                                                    
                                                }break;
                                                case 2:
                                                {
                                                    $penalty = rand(1,2);
                                                    switch($penalty)
                                                    {
                                                        case 1: Action::delCoin(40); break;
                                                        case 2: Action::delMaxHp(10); break;
                                                    }

                                                    echo '<h3 style="color: red;">Ludzie nie byli zadowoleni! Zostałeś ukarany!</h3>';
                                                    unset($penalty);
                                                }break;
                                            }

                                            DatabaseManager::updateTable('users', ['boolChurch' => 'true'], ['id' => $_SESSION['uid']]);
                                            unset($rng);

                                            echo '<br><div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                            
                                        }
                                        elseif(Get::get('jakie') == 'drugie')
                                        {
                                            echo '<h3>Twoje kazanie brzmiało następująco:';
                                            echo '<p style="text-align: justify;">
                                            Kiedyś Young Hulbój i Lil Piszczan postanowili się sprawdzić na siłowni u chudego
											Obydwoje dysponowali nieludzką siłą, która jest w stanie zniszczyć całe galaktyki
											Ich sparing trwał naprawdę długo, ale w końcu ich pięści spotkały się.
											Tak powstała jasna siła, czyste dobro i moc połączona z dwój bogów.
											Ta czysta energia zmaterializowała się jako Wielmożny Grześ.
											Był on jednocześnie najmądrzejszą istotą we wrzechświecie jak i najsilniejszą.
											Zamieszkał on w świecie bogów razem z Lil Piszczanem oraz Young Hulbójem.
											Jednak opuścił ten świat błąkając się po ludzkiej ziemi, nie mieszając się w koflikty tego świata.
                                            </p><br>';
                                            $rng = rand(1,2);
                                            switch($rng)
                                            {
                                                case 1:
                                                {
                                                    $prize = rand(1,3);
                                                    switch($prize)
                                                    {
                                                        case 1: Action::addCoin(60); break;
                                                        case 2: Action::addMaxHp(10); break;
                                                        case 3: Action::addIntelect(20); break;
                                                    }
                                                    
                                                    echo '<h3 style="color: lightgreen;">Ludzie byli zadowoleni! Otrzymałeś nagrodę!</h3>';
                                                    unset($prize);
                                                    
                                                }break;
                                                case 2:
                                                {
                                                    $penalty = rand(1,2);
                                                    switch($penalty)
                                                    {
                                                        case 1: Action::delCoin(40); break;
                                                        case 2: Action::delMaxHp(10); break;
                                                    }

                                                    echo '<h3 style="color: red;">Ludzie nie byli zadowoleni! Zostałeś ukarany!</h3>';
                                                    unset($penalty);
                                                }break;
                                            }

                                            DatabaseManager::updateTable('users', ['boolChurch' => 'true'], ['id' => $_SESSION['uid']]);
                                            unset($rng);

                                            echo '<br><div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                            
                                        }
                                        elseif(Get::get('jakie') == 'trzecie')
                                        {
                                            echo '<h3>Twoje kazanie brzmiało następująco:';
                                            echo '<p style="text-align: justify;">
                                            Mojżesz był wybranym człowiekiem. Wszysci żydzi znali oblicze Lil Piszczana, ale tylko Mojżesz był przy premierze jego kawałków.
											Jednak i on zaczął rapować, Lil Piszczan to dostrzegł i był z niego dumny.
											Dał mu wybór: nagrywać w KGB albo NBG
											Jednakże Mojżesz nie wykonał prośby i zaczął solową działalność jako xXxMojżesz.
											Za to żydów spotkała zagłada
                                            </p><br>';
                                            $rng = rand(1,2);
                                            switch($rng)
                                            {
                                                case 1:
                                                {
                                                    $prize = rand(1,3);
                                                    switch($prize)
                                                    {
                                                        case 1: Action::addCoin(60); break;
                                                        case 2: Action::addMaxHp(10); break;
                                                        case 3: Action::addIntelect(25); break;
                                                    }
                                                    
                                                    echo '<h3 style="color: lightgreen;">Ludzie byli zadowoleni! Otrzymałeś nagrodę!</h3>';
                                                    unset($prize);
                                                    
                                                }break;
                                                case 2:
                                                {
                                                    $penalty = rand(1,2);
                                                    switch($penalty)
                                                    {
                                                        case 1: Action::delCoin(40); break;
                                                        case 2: Action::delMaxHp(10); break;
                                                    }

                                                    echo '<h3 style="color: red;">Ludzie nie byli zadowoleni! Zostałeś ukarany!</h3>';
                                                    unset($penalty);
                                                }break;
                                            }

                                            DatabaseManager::updateTable('users', ['boolChurch' => 'true'], ['id' => $_SESSION['uid']]);
                                            unset($rng);

                                            echo '<br><div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                            
                                        }
                                        elseif(Get::get('jakie') == 'czwarte')
                                        {
                                            echo '<h3>Twoje kazanie brzmiało następująco:';
                                            echo '<p style="text-align: justify;">
                                            Świat stworzony przez Lil Piszczana był cudowny, jednak zaczynało się w nim szerzyć zło.
                                            Niektóre zło tego swiata zostało stworzone samoistnie poprzez wolną wolę ludzi. Takie zło 
                                            było możliwe do zamknięcia w twierdzi. Ta twierdza nazywała się "Tworków". Zarządzał nim Althof z rodu Neuhof.
                                            Miejsca pilnowała trójgłowa sarna strzegąca bram tworkowskich. Jednak powstało też zło potężne jak bogowie...
                                            </p><br>';
                                            $rng = rand(1,2);
                                            switch($rng)
                                            {
                                                case 1:
                                                {
                                                    $prize = rand(1,3);
                                                    switch($prize)
                                                    {
                                                        case 1: Action::addCoin(60); break;
                                                        case 2: Action::addMaxHp(10); break;
                                                        case 3: Action::addIntelect(20); break;
                                                    }
                                                    
                                                    echo '<h3 style="color: lightgreen;">Ludzie byli zadowoleni! Otrzymałeś nagrodę!</h3>';
                                                    unset($prize);
                                                    
                                                }break;
                                                case 2:
                                                {
                                                    $penalty = rand(1,2);
                                                    switch($penalty)
                                                    {
                                                        case 1: Action::delCoin(40); break;
                                                        case 2: Action::delMaxHp(10); break;
                                                    }

                                                    echo '<h3 style="color: red;">Ludzie nie byli zadowoleni! Zostałeś ukarany!</h3>';
                                                    unset($penalty);
                                                }break;
                                            }

                                            DatabaseManager::updateTable('users', ['boolChurch' => 'true'], ['id' => $_SESSION['uid']]);
                                            unset($rng);

                                            echo '<br><div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div>';
                                            
                                        }
                                        elseif(Get::get('jakie') == "piate")
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
                                            Action::addCoin(80);
                                            echo '<h3 style="color: lightgreen;">Udało ci się ukraść pieniądze z koszyczka, nikt tego nie zauważył!</h3>';
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

    <script>
        //2, 5, 3, 4

        let goSong = document.querySelector('#goSong');

        let song1 = document.querySelector('#song1');
        let song2 = document.querySelector('#song2');
        let song3 = document.querySelector('#song3');
        let song4 = document.querySelector('#song4');

        goSong.addEventListener('click', () => {
            console.log(song1.value + " | " + song2.value + " | " + song3.value + " | " + song4.value)

            if(song1.value == 2 && song2.value  == 5 && song3.value  == 3 && song4.value  == 4) {
               
            $.ajax({
            url : "ajax.php",
            method : "POST",
            data : {
                co: "piesn",
            }
            }).done((result) => {

                document.querySelector('#songGit').innerHTML = "Udalo Ci sie zaspiewac piesn! twoja nagroda to " + result;
                setTimeout(() => {
                    location.href = "index.php";
                }, '1000');                
            }) 
        }
        else {
            $.ajax({
            url : "ajax.php",
            method : "POST",
            data : {
                co: "death",
            }
            }).done((result) => {

                document.querySelector('#songGit').innerHTML = "<span style='color: red;'>Źle zaśpiewałeś psalm! Fanatyczni wyznawcy wymierzają Ci sprawiedliwość</span> ";

                setTimeout(() => {
                    location.reload();
                }, '1000');
            }) 
        }
        })


        function szkalowanie() {
            $.ajax({
            url : "ajax.php",
            method : "POST",
            data : {
                co: "szkalowaniePapieza",
            }
            }).done((result) => {

                document.querySelector('#papamessage').innerHTML = "<h3 style='color: red;'>Papież wyśmiał twojego wąsa. Nie wytrzymałeś takiego wstydu...</h3> ";

                setTimeout(() => {
                    location.href = "index.php";
                }, '1000');
            }) 
        }

        function rozmowa() {
            $.ajax({
            url : "ajax.php",
            method : "POST",
            data : {
                co: "rozmowaPapiez",
            }
            }).done((result) => {

                document.querySelector('#papamessage').innerHTML = "<h3 style='color: lightgreen;'>Rozmowa z papieżem była świetna! Dostałeś 2 punkty inteligencji</h3> ";
                setTimeout(() => {
                    location.href = "index.php";
                }, '1000');
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