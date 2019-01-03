<?php

	require_once('config.php');

	if(isset($_SESSION['logged']) && $_SESSION['logged'] == true)
		header('Location: template.php');
		
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Słysz Symulator Online</title>
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
				
				<div class="col-12 col-md-6 text-center" style="margin-top: 25px;" >
					Zaloguj
					
					<form action="login.php" method="POST">
						
					<div class="form-group" style="margin-top: 15px;">
						
					  <label for="usr">Login:</label>
					  <input type="text" class="form-control" id="user" name="login">
					</div>
					<div class="form-group">
					  <label for="pwd">Hasło:</label>
					  <input type="password" class="form-control" id="pwd" name="pass">
					</div>
						<input class="btn btn-dark btn-lg" type="submit" style="margin-bottom: 15px;">
					</form>
					
				</div>
				
				<div class="col-12 col-md-6 text-center" style="margin-top: 25px;">
					Zarejestruj
					
					<form action="register.php" method="POST">
						
					<div class="form-group" style="margin-top: 15px;">
						
					  <label for="usr">Login:</label>
					  <input type="text" class="form-control" name="login">
					</div>
					<div class="form-group">
					  <label for="pwd">Hasło:</label>
					  <input type="password" class="form-control" name="pass">
					</div>
					<div class="form-group">
					  <label for="pwd">email:</label>
					  <input type="email" class="form-control" name="email">
					</div>
						<input class="btn btn-dark btn-lg" type="submit" style="margin-bottom: 15px;">
					</form>
					
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