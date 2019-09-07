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
								
				<div class="col-12 text-center display-4">Sklep</div>
				
				<div class="col-12 col-md-6" style="margin-top: 15px;">

                       <?php
                            echo '<h3>Oto rzeczy dostępne dla ciebie!</h3>';
                            echo '<br><div class="btn-dark btn-lg href" id="index.php">Wróć do domu </div><br>';
                            
                            //href="#collapseExample"
                             /*   echo '<div class="btn-dark btn-lg shop" id="1">Patyk</div>';

                                echo "
                                <div class='collapse' id='coll1' style='color: black;'>
                                <div class='card card-body'>
                                   Randomowa treść po najechaniu na to XD
                                </div>
                                </div>                           
                                ";
                            
                                $itemData = DatabaseManager::selectbySQL("SELECT id, name, rarity, forLevel, vendorCost, addDamage FROM items ORDER BY id");
                                
                                for($i=0; $i<25; $i++)
                                {
                                    $iCost = $itemData[$i]['vendorCost'];
                                    $iLvl = $itemData[$i]['addDamage'];
                                    $iDmg = $itemData[$i]['forLevel'];
                                    
                                    echo '<div class="btn-dark btn-lg shop" id="'.$itemData[$i]['id'].'">'.$itemData[$i]['name'].'</div>';

                                    echo "
                                <div class='collapse' id='coll$i' style='color: black;'>
                                <div class='card card-body' id='$i'>
                                   Dostępne od: $iLvl poziomu<br>
                                   Obrażenia: $iDmg<br>
                                   Koszt: $iCost
                                </div>
                                </div>                           
                                ";

                                }
                                */

                                $itemData = DatabaseManager::selectbySQL("SELECT id, name, rarity, forLevel, vendorCost, addDamage FROM items ORDER BY id");

                                //wole to trzymać w zmiennej niż męczyć bazędanych
                                $checkCost = DatabaseManager::selectBySQL("SELECT slyszCoin FROM users WHERE id=".$_SESSION['uid'])[0]['slyszCoin'];
                                $checkLvl = DatabaseManager::selectBySQL("SELECT userLevel FROM users WHERE id=".$_SESSION['uid'])[0]['userLevel'];

                                for($i=0; $i<30; $i++)
                                {
                                    $iName = $itemData[$i]['name'];
                                    $iCost = $itemData[$i]['vendorCost'];
                                    $iLvl = $itemData[$i]['forLevel'];
                                    $iDmg = $itemData[$i]['addDamage'];
                                    $count = $i +1;
                                    $iId = $itemData[$i]['id'];

                                    if(($checkCost < $iCost)||($checkLvl < $iLvl))
                                    {
                                        $color = 'red';
                                    } 
                                    else
                                    {
                                        $color = '';
                                    }                               
                                        //echo '<div class="btn-dark btn-lg shop" id="'.$count.'"><p style="color: '.$color.';">'.$iName.'(Lvl: '.$iLvl.') Obrażenia: '.$iDmg.' Koszt: '.$iCost.'SC</p></div>';
                                        echo '<div class="btn-dark btn-lg shop" id="'.$count.'"><p style="color: '.$color.';">'.$iName.' '.EqManager::stat($iId).' Koszt: '.$iCost.'SC</p></div>';
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
    
    <script>  
        function buy(itemid) {
            $.ajax({
            url : "ajax.php",
            method : "POST",
            data : {
                co: "sklep",
                id: itemid
            }
            }).done((result) => {
                location.reload();
            })   
        }


        const coll1 = $('#coll1');
        $( '#1' ).mouseenter( function() { 
               coll1.collapse('show');
            } 
            ).mouseleave( 
            function() { 
                coll1.collapse('hide') ;
            }
         );

        document.addEventListener('DOMContentLoaded', () =>  {
        let buttons = document.querySelectorAll('.shop');
            
        for(let i = 0; i < buttons.length; i++) {
            const thisButton = buttons[i];
            buttons[i].addEventListener('click', () => {
                buy(thisButton.id);
            })
        }
    })
    </script>


</body>
</html>