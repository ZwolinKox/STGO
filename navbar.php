<?php
$nick = DatabaseManager::selectBySQL("SELECT username FROM users WHERE id=".$_SESSION['uid'])[0]['username'];

echo '<div class="col-4 btn btn-dark btn-lg href" id="ksiazka.php?profile='.$nick.'">Profil</div>';
echo '<div class="col-4 btn btn-dark btn-lg href" id="ranking.php">Ranking</div>';
echo '<div class="col-4 btn btn-dark btn-lg href" id="logout.php">Wyloguj</div>';
?>