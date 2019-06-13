<?php

require_once 'config.php';

    if(Post::exist('co'))
    {
		if(Post::get('co') == 'gangName')
        {		
	
			$usr = DatabaseManager::selectBySQL("SELECT id FROM guilds WHERE guildName='".Post::get('gangName')."' LIMIT 1")[0]["id"];

            if($usr >= 1)
				die("fail");
			else
				die("success");
				
        }
        
        elseif (Post::get('co') == 'createGang') {
            DatabaseManager::insertInto("guilds", ["guildName" => Post::get('gangName'), "guildOwner" => Session::get('uid')]);

            DatabaseManager::updateTable("users", ["guildName" => '"'.Post::get('gangName').'"', "boolGuild" => 1], ["id" => Session::get('uid')]);

            die("success");
        }

        elseif(Post::get('co') == 'deleteGuildMember')
        {
            Guild::deleteGuildMemberByNumber(Post::get('member'));
        }

        elseif(Post::get('co') == 'deleteGuild')
        {
            Guild::deleteGuild();
        }

        elseif(Post::get('co') == 'leaveGuild') {
            Guild::leaveGuild();
        }

        elseif(Post::get('co') == 'inviteMember') {
            $guildName = DatabaseManager::selectBySQL("SELECT guildName FROM users WHERE id=".$_SESSION['uid'])[0]['guildName'];
            $guildInfo =  DatabaseManager::selectBySQL("SELECT * FROM guilds WHERE guildName='".$guildName."'")[0];

            if($guildInfo['guildOwner'] == $_SESSION['uid'])
            {
                
                $playerName = Post::get('playerName');
               

                $playerId = DatabaseManager::selectBySQL("SELECT id FROM users WHERE username='$playerName'")[0]['id'];

                if($playerId <= 0)
                    die("Taki gracz nie istnieje!");

                $usr = DatabaseManager::selectBySQL("SELECT id FROM ganginv WHERE playerId='$playerId' AND guildName='$guildName' AND visible=1 LIMIT 1")[0]["id"];

                if($usr >= 1)
                    die("Gracz posiada oczekujace zaproszenie przez twój gang!");

                    
                if(DatabaseManager::selectBySQL("SELECT boolGuild FROM users WHERE id=$playerId")[0]['boolGuild'] == 1)
                    die("Gracz jest już członkiem jakiejś gildii!");

                
                DatabaseManager::insertInto('ganginv', ['visible' => 1, 'guildName' => $guildName, 'playerId' => $playerId]);

                die('success');
            }

             
        }

        elseif (Post::get('co') == 'sendMoneyGuild') {
            $guildName = DatabaseManager::selectBySQL("SELECT guildName FROM users WHERE id=".$_SESSION['uid'])[0]['guildName'];
            //$guildInfo =  DatabaseManager::selectBySQL("SELECT * FROM guilds WHERE guildName='".$guildName."'")[0];
            $money = abs(Post::get('money'));

            if(DatabaseManager::selectBySQL('SELECT slyszCoin FROM users WHERE id='.$_SESSION['uid'])[0]['slyszCoin']  >= $money)
            {
                DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszcoin-'.$money], ['id' => $_SESSION['uid']]);
                DatabaseManager::updateTable('guilds', ['guildBankSlyszCoin' => 'guildBankSlyszCoin+'.$money], ['guildName' => '"'.$guildName.'"']);
            }
        }

        elseif (Post::get('co') == 'getMoneyGuild') {
            $guildName = DatabaseManager::selectBySQL("SELECT guildName FROM users WHERE id=".$_SESSION['uid'])[0]['guildName'];
            $guildInfo =  DatabaseManager::selectBySQL("SELECT * FROM guilds WHERE guildName='".$guildName."'")[0];
            $money = abs(Post::get('money'));

            if($guildInfo['guildOwner'] == $_SESSION['uid'])
            {
                if(DatabaseManager::selectBySQL('SELECT guildBankSlyszCoin FROM guilds WHERE guildName="'.$guildName.'"')[0]['guildBankSlyszCoin']  >= $money)
                {
                    DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszcoin+'.$money], ['id' => $_SESSION['uid']]);
                    DatabaseManager::updateTable('guilds', ['guildBankSlyszCoin' => 'guildBankSlyszCoin-'.$money], ['guildName' => '"'.$guildName.'"']);
                }
            }


        }

        elseif (Post::get('co') == 'drivingLicence') {
            if(Action::getCoins() < 20000)
                die('Nie posiadasz 20 000 SC!');

            if(DatabaseManager::selectBySQL("SELECT userLevel FROM users WHERE id=".$_SESSION['uid'])[0]['userLevel'] < 30)
                die("Nie posiadasz 30 poziomu!");

            if(DatabaseManager::selectBySQL("SELECT drivingLicence FROM users WHERE id=".$_SESSION['uid'])[0]['drivingLicence'] == true)
                die("Posiadasz już prawo jazdy!");

            DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-20000', 'drivingLicence' => 1], ['id' => $_SESSION['uid']]);

            die('success');
            
        }

        elseif (Post::get('co') == 'melanz') {

            $dayWeek = DatabaseManager::selectBySQL('SELECT dayWeek FROM users WHERE id='.Session::get('uid'))[0]['dayWeek'];

            $dayWeek++;

            if($dayWeek == 7)
            {
                DatabaseManager::updateTable('users', ['lastSunday' => "now()"], ['id' => $_SESSION['uid']]);
            }

            if($dayWeek > 7) {
                $dayWeek = 1;
                DatabaseManager::updateTable('users', ['boolChurch' => 0, 'boolSchoolBan' => 0], ['id' => Session::get('uid')]);  
            }
                

            DatabaseManager::updateTable('users', ['userEnergy' => '100', 'statHp' => 'maxHp', 'dayWeek' => $dayWeek, 'dayGame'=>'dayGame+1', 'boolLotek' => 0, 'boolSchool' => 0], ['id' => $_SESSION['uid']]);



            if(rand(1, 4) == 1)
            {
                echo "<span style='color: red;'>Impreza się ledwo rozpoczcęła, a twoi rodzice wrócili do domu! </span>";
            }

            elseif(Post::get('trunki') == '1' && Post::get('ludzie') == '3' && Post::get('taniec') == 2)
            {
                $wynik = rand(1, 3);

                if($wynik == 1) {
                    echo "<span style='color: lightgreen;'>Impreza się ledwo rozpoczcęła, a całe miasto wbiło do mieszkania. Nie sądziłeś, że przyjdą. 
                    Całe szczęście kupiłeś bardzo dużo soku. Jednak przyszła wyjątkowa osoba. Twój najlepszy kolega, osoba Ci najbliższa.
                    Dzisiaj nie jest on zwykłym człowiekiem. Jest archaniołem w legendarnej armii Lil Piszczana, ale udało mu się tutaj dotrzeć.
                    Postanowiliście, że zrobicie to co parę lat temu w barze gdzie zaproponowałeś mu zmianę stylu życia. Ostatni taniec.
                    Od tamtego momentu od nowa odkrył w sobie moc, która doprowadziła go do tego gdzie jest teraz. Postanowiliście zatańczyć na stole.
                    Niektórzy uciekli, ale nie przejmowaliście się tym. I w ten sposób bawiliście się do rana</span>";
                    
                    DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin+20'], ['id' => $_SESSION['uid']]);

                }
                elseif ($wynik == 2) {
                    echo "<span style='color: red;'>Nikt do Ciebie nie przyszedł. Totalnie nikt. Każdy Cię olał</span>";
                }
                elseif ($wynik == 3) {
                    echo "<span style='color: red;'>Impreza się ledwo rozpoczcęła, a całe miasto wbiło do mieszkania. Nie sądziłeś, że przyjdą. Nie widziałeś w tej grupce swojego
                    najlepszego przyjaciela. Szybko okazało się, że do twojego soczku ktoś dolał metanol. Masowa ślepota ogarnęła wszystkich na imprezie. Możesz czuć się za to 
                    odpowiedzialny, nie dopilnowałeś wszystkiego, a przecież zaprosiłeś całe miasto. Zostało Ci tylko tańczyć na stole, aż przyjedzie policja </span>";
                }
            }

            elseif(Post::get('trunki') == '3' && Post::get('ludzie') == '1')
            {
                $wynik = rand(1, 3);

                if($wynik == 1) {
                    echo "<span style='color: lightgreen;'>Impreza się ledwo rozpoczcęła, a twoi kumple byli już w drzwiach. Postanowiliście zrobić sesję RPG.
                    Mityczne stworzenia, smoki i inne krasnoludy nagle pojawiły się w pomieszczeniu. Nie do końca wiedzieliście co się dzieje.
                    Kilka chwil potem kolega rzucił się na jednego z nich tocząc z nim epicką walkę. Niestety odniósł poważne obrażenia. On umierał.
                    Wszyscy płakaliście. To był najmocniejszy FreeWave trip jaki was spotkał</span>";

                    DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin+20'], ['id' => $_SESSION['uid']]);

                }
                elseif ($wynik == 2) {
                    echo "<span style='color: red;'>Nikt do Ciebie nie przyszedł. Totalnie nikt. Każdy Cię olał. Ale przynajmniej piesek napił się z tobą piwka. To chyba dobrze? Halo piesku?</span>";
                    DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-20'], ['id' => $_SESSION['uid']]);
                }
                elseif ($wynik == 3) {
                    echo "<span style='color: red;'>Impreza się ltylko tańczyć na stole, a koledzy stali w dzwiach. Jeden kolega nie wyglądał za dobrze, mówił, że nie pije dziś FreeWaveColi. Nie pytaliśmy o powód.
                    Jednak jeden z nas myślał, że pożartuje i mu doleje do soku. Okazało się, że wcześniej zarzył Esperal. Jego pogrzeb jest we wtorek</span>";
                    DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-20'], ['id' => $_SESSION['uid']]);

                }
            }


            
            elseif(Post::get('trunki') == '2' && Post::get('ludzie') == '3' &&  Post::get('spiew') == '4')
            {
                $wynik = rand(1, 3);

                if($wynik == 1) {
                    echo "<span style='color: lightgreen;'>Impreza się ledwo rozpoczcęła, a setki osób przychodzi na koncert xXXxMojżesza w twoim domu
                    . Może mało miejsca, ale i tak dacie radę, jest alkohol, dobra muzyka i masa ludzi. Może być lepiej?</span>";
                    
                    DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin+20'], ['id' => $_SESSION['uid']]);
                }
                elseif ($wynik == 2) {
                    echo "<span style='color: red;'>Nikt do Ciebie nie przyszedł. Totalnie nikt. Każdy Cię olał. Więc sam zacząłeś rapować po pijaku aż ktoś rzucił Cię piłką przez okno</span>";
                    DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-20'], ['id' => $_SESSION['uid']]);

                }
                elseif ($wynik == 3) {
                    echo "<span style='color: red;'>Okazało się, że raper Young Ligma nie istnieje, a ludzie żądają koncertu. Ostatecznie zostałeś ośmieszony i wszyscy Cię opuścili</span>";
               
                    DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-20'], ['id' => $_SESSION['uid']]);

                }
            }
            else {
                $wynik = rand(1, 5);

                if($wynik == 1) {
                    echo "<span style='color: lightgreen;'>Impreza się ledwo rozpoczcęła, a nagle odwiedza imprezę Young Hulbój w swojej nowej postaci
                    . Wszystcy myślą, że to P********3, ale ty wiesz, że to on. Przyjął nowe ciało, żeby tanim kosztem móc się alkoholizować, przyniósł własne trunki.
                    Melanż zapowiada się wspaniały</span>";

                    DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin+20'], ['id' => $_SESSION['uid']]);

                }
                elseif ($wynik == 2) {
                    echo "<span style='color: red;'>Nikt do Ciebie nie przyszedł. Totalnie nikt. Każdy Cię olał. Nic nowego</span>";
                
                    DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-20'], ['id' => $_SESSION['uid']]);
                }
                elseif ($wynik == 3) {
                    echo "<span style='color: lightgreen;'>Okazało się, że raper Young Ligma nie istnieje, ale udało się coś załatwić. Impreza była fajna, spokojna. Dobre.<span>";
               
                    DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin+20'], ['id' => $_SESSION['uid']]);

                }
                elseif ($wynik == 4) {
                    echo "<span style='color: red;'>Impreza to była totalna klapa, nawet nie ma co tego komentować..</span>";
                    DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-20'], ['id' => $_SESSION['uid']]);
                }
                elseif ($wynik == 5) {
                    echo "<span style='color: red;'>No cóż można powiedzieć, dziewczyna do której podbijałeś na imprezie Cię wyśmiała. Czy przebieg imprezy ma znaczenie?..</span>";
                    DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-20'], ['id' => $_SESSION['uid']]);
                }

            }

            die('<div class="btn-dark btn-lg" onclick="location.href = `index.php`">Wyśpij się</div>');
            
        }

        elseif(Post::get('co') == 'nextLevelGuild')
        {
            $guildName = DatabaseManager::selectBySQL("SELECT guildName FROM users WHERE id=".$_SESSION['uid'])[0]['guildName'];
            $guildInfo =  DatabaseManager::selectBySQL("SELECT * FROM guilds WHERE guildName='".$guildName."'")[0];

            if($guildInfo['guildOwner'] == $_SESSION['uid'])
            {
                $guildNextLevelSC = ($guildInfo['guildLevel']+1)*1200 - 500;

                if($guildInfo['guildBankSlyszCoin'] >= $guildNextLevelSC)
                {
                    DatabaseManager::updateTable('guilds', ['guildBankSlyszCoin' => 'guildBankSlyszCoin-'.$guildNextLevelSC, 'guildLevel' => 'guildLevel+1'], ['guildName' => '"'.$guildName.'"']);
                    die('yes');
                }

                die('no');
            }
        }

        elseif (Post::get('co') == 'newEnemyGang' || Post::get('co') == "newFriendGang") {

            $guildName = DatabaseManager::selectBySQL("SELECT guildName FROM users WHERE id=".$_SESSION['uid'])[0]['guildName'];
            $guildInfo =  DatabaseManager::selectBySQL("SELECT * FROM guilds WHERE guildName='".$guildName."'")[0];
			
			if(Post::get("gangName") == $guildName)
				die("Nie możesz posiadać stosunków dyplomatycznych z własnym klanem!");

            if($guildInfo['guildOwner'] != $_SESSION['uid'])
                die('Nie jestes założycielem gangu!');

            $otherGuildInfo = DatabaseManager::selectBySQL("SELECT * FROM guilds WHERE guildName='".Post::get('gangName')."'")[0];
            $otherGuildName = $otherGuildInfo['guildName'];
            $myId = $_SESSION['uid'];
            
            if($otherGuildInfo['id'] < 1)
                die('Taki gang nie istnieje!');

            $result = DatabaseManager::selectbySQL("SELECT * FROM guilddiplomacy WHERE ( guildOne='$guildName' AND guildTwo='$otherGuildName' ) OR ( guildOne='$otherGuildName' AND guildTwo='$guildName' )")[0];

            if($result['id'] >= 1)
                die('Posiadasz już stosunki dyplomatyczne z tym gangiem');

            $type;
            if(Post::get('co') == 'newEnemyGang')
                $type = "Wojna";
            elseif (Post::get('co') == 'newFriendGang') 
                $type = "Sojusz";
            

            DatabaseManager::insertInto('guilddiplomacy', ['guildOne' => $guildName, 'guildTwo' => $otherGuildInfo['guildName'], 'type' => $type]);

            die('success');
        }

        elseif(Post::get('co') == 'sendItemGuild') {
            $itemId = Post::get('itemId');
            $guildName = DatabaseManager::selectBySQL("SELECT guildName FROM users WHERE id=".$_SESSION['uid'])[0]['guildName'];
            $depoSlot;

            if(DatabaseManager::selectBySQL("SELECT guildBankSlotOne FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotOne'] == 0)
            {
                $depoSlot = 'guildBankSlotOne';
            }
            elseif(DatabaseManager::selectBySQL("SELECT guildBankSlotTwo FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotTwo'] == 0)
            {
                $depoSlot = "guildBankSlotTwo";
            }
            elseif(DatabaseManager::selectBySQL("SELECT guildBankSlotThree FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotThree'] == 0)
            {
                $depoSlot = "guildBankSlotThree";            
            }
            elseif(DatabaseManager::selectBySQL("SELECT guildBankSlotFour FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotFour'] == 0)
            {
                $depoSlot = "guildBankSlotFour";
            }
            elseif(DatabaseManager::selectBySQL("SELECT guildBankSlotFive FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotFive'] == 0)
            {
                $depoSlot = "guildBankSlotFive";  
            }
            elseif(DatabaseManager::selectBySQL("SELECT guildBankSlotSix FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotSix'] == 0)
            {
                $depoSlot = "guildBankSlotSix";
            }
            elseif(DatabaseManager::selectBySQL("SELECT guildBankSlotSeven FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotSeven'] == 0)
            {
                $depoSlot = "guildBankSlotSeven";  
            }
            elseif(DatabaseManager::selectBySQL("SELECT guildBankSlotEight FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotEight'] == 0)
            {
                $depoSlot = "guildBankSlotEight";  
            }
            elseif(DatabaseManager::selectBySQL("SELECT guildBankSlotNine FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotNine'] == 0)
            {
                $depoSlot = "guildBankSlotNine";  
            }
            elseif(DatabaseManager::selectBySQL("SELECT guildBankSlotTen FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotTen'] == 0)
            {
                $depoSlot = "guildBankSlotTen";  
            }
            else
                die('Nie ma miejsca w depozycie gangu!');

            if(EqManager::findItem($itemId) == null) 
                die('Nie posiadasz takiego przedmiotu!');

            //die($itemId);

            DatabaseManager::updateTable('users', [EqManager::findItem($itemId) => 0], ['id' => $_SESSION['uid']]);
            DatabaseManager::updateTable('guilds', [$depoSlot => $itemId], ['guildName' => "'".$guildName."'"]);

            die('success');

        }

        elseif(Post::get('co') == 'death') {
            UserManager::death();
        }

        elseif (Post::get('co') == "piesn") {

            $add = rand(1, 3);

            DatabaseManager::updateTable('users', ['boolChurch' => 'true'], ['id' => $_SESSION['uid']]);


            switch($add) 
            {
                case 1:
                {
                    DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin+10'], ['id' => $_SESSION['uid']]);
                    die('Otrzymałeś 10 slyszCoinów!');
                } break;

                case 2:
                {
                    DatabaseManager::updateTable('users', ['slyszCoin' => 'slyszCoin-15'], ['id' => $_SESSION['uid']]);
                    die('Fałszowałeś, więc straciłeś 15 slyszCoinow!');
                } break;

                case 3:
                {
                    DatabaseManager::updateTable('users', ['statStrength' => 'statStrength+4'], ['id' => $_SESSION['uid']]);
                    die('Od machania mikrofonem wzrosła twoja siła o 4!');
                } break;
            }

            

        }

        elseif(Post::get('co') == 'getItemGuild') {
            $itemId = Post::get('itemId');
            $guildName = DatabaseManager::selectBySQL("SELECT guildName FROM users WHERE id=".$_SESSION['uid'])[0]['guildName'];
            $depoSlot;

        if(DatabaseManager::selectBySQL("SELECT guildBankSlotOne FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotOne'] == $itemId)
        {
            $depoSlot = "guildBankSlotOne";
        }
        else if(DatabaseManager::selectBySQL("SELECT guildBankSlotTwo FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotTwo'] == $itemId)
        {
            $depoSlot = "guildBankSlotTwo";
        }
        else if(DatabaseManager::selectBySQL("SELECT guildBankSlotThree FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotThree'] == $itemId)
        {
            $depoSlot = "guildBankSlotThree";
        }
        else if(DatabaseManager::selectBySQL("SELECT guildBankSlotFour FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotFour'] == $itemId)
        {
            $depoSlot = "guildBankSlotFour";
        }
        else if(DatabaseManager::selectBySQL("SELECT guildBankSlotFive FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotFive'] == $itemId)
        {
            $depoSlot = "guildBankSlotFive";
        }
        else if(DatabaseManager::selectBySQL("SELECT guildBankSlotSix FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotSix'] == $itemId)
        {
            $depoSlot = "guildBankSlotSix";
        }
        else if(DatabaseManager::selectBySQL("SELECT guildBankSlotSeven FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotSeven'] == $itemId)
        {
            $depoSlot = "guildBankSlotSeven";
        }
        else if(DatabaseManager::selectBySQL("SELECT guildBankSlotEight FROM guilds WHERE guildName='".$guildName."'")[0]['guildBankSlotEight'] == $itemId)
        {
            $depoSlot = "guildBankSlotEight";
        }
        else
        {
            die('Nie ma takiego przedmiotu w depozycie!');
        }

        $eqSlot = EqManager::findSpace();
            if($eqSlot == null) 
                die('Nie masz wolnego miejsca w ekwipunku!');

            //die($itemId);

            DatabaseManager::updateTable('users', [$eqSlot => $itemId], ['id' => $_SESSION['uid']]);
            DatabaseManager::updateTable('guilds', [$depoSlot => 0], ['guildName' => "'".$guildName."'"]);

            die('success');

        }

        elseif (Post::get('co') == 'guildAccept') {

            $guildName = Post::get('guildName');
            $guildInfo =  DatabaseManager::selectBySQL("SELECT * FROM guilds WHERE guildName='".$guildName."'")[0];
            $myId = $_SESSION['uid'];

            //Możliwe błędy
            if($guildInfo['id'] < 1)
                die('Taki gang nie istnieje!');

            $usr = DatabaseManager::selectBySQL("SELECT id FROM ganginv WHERE playerId='$myId' AND guildName='$guildName' AND visible=1 LIMIT 1")[0]["id"];

            if($usr <= 0)
                die("Nie posiadasz zaproszenia do tego gangu!");

                $number = null;

                    if($guildInfo['guildMemberTwo'] == 0)
                        $number = 'guildMemberTwo';

                    elseif($guildInfo['guildMemberThree'] == 0)
                        $number = 'guildMemberThree';

                    elseif($guildInfo['guildMemberFour'] == 0)
                        $number = 'guildMemberFour';

                    elseif($guildInfo['guildMemberFive'] == 0)
                        $number = 'guildMemberFive';

                    elseif($guildInfo['guildMemberSix'] == 0)
                        $number = 'guildMemberSix';

                    elseif($guildInfo['guildMemberSeven'] == 0)
                        $number = 'guildMemberSeven';

                    elseif($guildInfo['guildMemberEight'] == 0)
                        $number = 'guildMemberEight';

                    elseif($guildInfo['guildMemberNine'] == 0)
                        $number = 'guildMemberNine';

                    elseif($guildInfo['guildMemberTen'] == 0)
                        $number = 'guildMemberTen';

                if($number == null)
                    die("Klan nie posiada wolnych miejsc!");
            
                DatabaseManager::updateTable("ganginv", ['visible' => 0], ['guildName' => '"'.$guildName.'"', 'visible' => 1]);
                DatabaseManager::updateTable("users", ["guildName" => '"'.$guildName.'"', "boolGuild" => "1"], ["id" => $_SESSION['uid']]);
                DatabaseManager::updateTable('guilds', [$number => $_SESSION['uid']], ['guildName' => '"'.$guildName.'"']);

                die('success'); 

            
        }

        elseif (Post::get('co') == "guildDecline") {
            $guildName = Post::get('guildName');
            DatabaseManager::updateTable("ganginv", ['visible' => 0], ['guildName' => '"'.$guildName.'"', 'visible' => 1]);
        }

        //Toaleta
        elseif(Post::get('co') == 'jedyneczka')
        {
            ButtonFunc::jedyneczka();
        }
        elseif(Post::get('co') == 'dwojeczka')
        {
            ButtonFunc::dwojeczka();
        }
        //Sklepik szkolny
        elseif(Post::get('co') == 'hamburger')
        {
            ButtonFunc::sklepikBurger();
        }
        elseif(Post::get('co') == 'tost')
        {
            ButtonFunc::sklepikTost();
        }
        elseif(Post::get('co' == 'kawa'))
        {
            ButtonFunc::sklepikKawa();
        }
        //Biblioteka
        elseif(Post::get('co') == 'horror')
        {
            ButtonFunc::czytaj('horror');
        }
        elseif(Post::get('co') == 'przygodowa')
        {
            ButtonFunc::czytaj('przygodowa');
        }
        elseif(Post::get('co') == 'naukowa')
        {
            ButtonFunc::czytaj('naukowa');
        }
        elseif(Post::get('co') == 'rozgrzewka')
        {
            ButtonFunc::salaCwiczenie('rozgrzewka');
        }
        elseif(Post::get('co') == 'materac')
        {
            ButtonFunc::salaCwiczenie('materac');
        }
        elseif(Post::get('co') == 'changeItem') 
        {
            if(EqManager::checkHand(DatabaseManager::selectBySQL('SELECT '.$_POST['itemName'].' FROM users WHERE id='.$_SESSION['uid'])[0][$_POST['itemName']])) {
                DatabaseManager::updateTable('users', ['eqMainHand' => $_POST['itemName']], ['id' => $_SESSION['uid']]);
                unset($_POST['itemName']);
            }

        }
        elseif(Post::get('co') == 'deleteItem') 
        {
            DatabaseManager::updateTable('users', [$_POST['itemName'] => 0], ['id' => $_SESSION['uid']]);
            unset($_POST['itemName']);
        }
        //McDonald
        elseif(Post::get('co') == 'burgerslysz')
        {
            ButtonFunc::jedzBurger();
        }
        elseif(Post::get('co') == 'bigslysz')
        {
            ButtonFunc::jedzBig();
        }
        //Aldi
        elseif(Post::get('co') == 'kamizelka')
        {
            ButtonFunc::buyVest();
        }
        elseif(Post::get('co') == 'czesci')
        {
            ButtonFunc::pcUpgrade();
        }
        //Stacja benzynowa
        elseif(Post::get('co') == 'hotdog')
        {
            ButtonFunc::hotdog();
        }
        elseif(Post::get('co') == 'sklep')
        {
            TradeManager::buyById(Post::get('id'));
        }
        elseif(Post::get('co') == 'build')
        {   
            Miner::build();
        }
        elseif(Post::get('co') == 'upgrade')
        {
            Miner::upgrade();
        }
    }

?>