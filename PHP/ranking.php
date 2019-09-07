<!DOCTYPE html>
<?php

    require_once('config.php');

    require_once('checkLogin.php');


    if(!isset($_GET['sort']))
        $_SESSION['sort'] = 'userLevel';
    elseif($_GET['sort'] == '1')
        $_SESSION['sort'] = 'userLevel';
    elseif ($_GET['sort'] == '2') {
        $_SESSION['sort'] = 'userLeaguePoints';
    }
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
                
        <div class="col-12 text-center display-4">Ranking</div>

                <div class="col-12 text-center">

                <?php

                echo '<label for="sorts">Sortuj według:</label>
                    <select class="form-control" name="sorts" id="sorts">
                        <option value="1">Poziom</option>
                        <option value="2">Punkty ligowe</option>
                    </select>
                ';
                
                    $sort =  $_SESSION['sort'];
                    $wynik = DatabaseManager::selectbySQL("SELECT username, userLeaguePoints, userLevel, team FROM users ORDER BY $sort DESC LIMIT 10");

                    echo '<br> <div class="btn-success btn-lg" id="sort">Sortuj</div><br>';
                    echo '<br> <div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div><br>';
                    echo '<br><table class="table table-striped table-dark">
                            <thead>
                            <tr>
                                <th scope="col">Miejsce</th>
                                <th scope="col">Nick</th>
                                <th scope="col">Poziom</th>
                                <th scope="col">Punkty ligowe</th>
                            </tr>
                            <tbody>';
                    for($i=count($wynik)-1; $i != -1; $i--)
                    {
                        $rNick = $wynik[abs($i-9)]['username'];
                        $rLvl = $wynik[abs($i-9)]['userLevel'];
                        $rPnt = $wynik[abs($i-9)]['userLeaguePoints'];
                        $count = abs($i - 10);
                        switch($wynik[abs($i-9)]['team'])
                        {
                             case '1': $color = '#ffcd2b'; break;
                             case '2': $color = '#ff1616'; break;
                             case '3': $color = '#42c5f4'; break;     
                        }                       

                    echo '
                            <tr>
                                <th scope="row">'.$count.'</th>
                                <td><a href="ksiazka.php?profile='.$rNick.'" style="color: '.$color.';">'.$rNick.'</a></td>
                                <td>'.$rLvl.'</td>
                                <td>'.$rPnt.'</td>
                            </tr>';
                    }
                    echo    '</tbody>
                            </table>';

                            //Powrót tutaj trzeba dodać
                ?>
        </div>
    </div> <!-- ŚRODEK -->

  <br/><br/>
    
    <footer style="background-color: rgb(37, 37, 44); padding-top: -10px;" class="footer fixed-bottom text-center">
        Słysz Symulator 2018 &copy; Wszelkie prawa zastrzeżone
    </footer>

    <script>

        document.querySelector('#sort').addEventListener('click', () => {
            let sort = document.querySelector('#sorts').value;

            location.href = "ranking.php?sort=" + sort;
        })


    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>