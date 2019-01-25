<!DOCTYPE html>
<?php

    require_once('config.php');

    CheckUrl::check();

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
								
				<div class="col-12 text-center display-4">Witamy na Skłodowskiej!</div>
				
				<div class="col-12 col-md-6" style="margin-top: 15px;">


                <div class="btn-dark btn-lg href" id="pvp.php">Szukaj zaczepki</div>
                <div class="btn-dark btn-lg href" id="szkola.php">Wróć do spokojniejszego miejsca</div>
                <div style="margin-bottom: 40px;"></div>

                <div id='chat' class="card text-white bg-secondary">
                <div  class="card-header" style="font-size: 32px;">Chat</div>

                
                </div>


                <div class="input-group mb-3">
                <input id="messageToSend" type="text" class="form-control" placeholder="Wpisz wiadomość" aria-label="Wpisz wiadomość" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button id="sendMessage" class="btn btn-outline-danger" type="button" id="button-addon2">Wyślij</button>
                </div>
                </div>

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

    <script>

        const oldChat = document.querySelector('#chat').innerHTML;
        document.addEventListener('DOMContentLoaded', () => {
            const color = 'blue';

            const messageToSend = document.querySelector('#messageToSend');
            const sendMessage = document.querySelector('#sendMessage');
            const chat = document.querySelector('#chat');

            sendMessage.addEventListener('click', () => {
                chat.innerHTML += `

            `;

            $.ajax({
            url : "sendPublicMessage.php",
            method : "POST",
            data : {
                co : "sendMessage",
                message : messageToSend.value
            }
            }).done((result) => {
                
            })

           

            })

            setInterval(() => {
                $.ajax({
                url : "sendPublicMessage.php",
                method : "POST",
                data : {
                    co : "recMessage",
                }
                }).done((result) => {
                    obj = JSON.parse(result);

                    chat.innerHTML = oldChat;

                    console.log(obj);
                    for(let i = obj.length-1; i > -1 ; i--) 
                    {
                        
                        chat.innerHTML += `
                        <div class="card-body">
                        <div class="card-text">
                        
                        <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0" style="color: ${ obj[i].color };">${ obj[i].nick }</h5>
                            ${ obj[i].mess }
                        </div>
                        </div>
                        </div>
                        
                        
                        </div>
                        `;
                    }
                })
            }, '500');
        })

        
        
    </script>
	

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>