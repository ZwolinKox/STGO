<?php
require_once('config.php');

$data = DatabaseManager::selectBySQL("SELECT * FROM users");

for($i = 0; $i < count($data); $i++)
{
    $output = $data[$i]['id'].' '.$data[$i]['email'].' '.$data[$i]['pass'].' '.$data[$i]['username'].' '.$data[$i]['dayGame'].' '.$data[$i]['slyszCoin'].' '.$data[$i]['xpPoints'].' '.$data[$i]['userLevel'].' '.$data[$i]['userLeaguePoints'].' '.$data[$i]['statStrength'].' '.$data[$i]['statIntelect'].' '.$data[$i]['eqMainHand'].' '.$data[$i]['eqSlotOne'].' '.$data[$i]['eqSlotTwo'].' '.$data[$i]['eqSlotThree'].' '.$data[$i]['eqSlotFour'].' '.$data[$i]['eqSlotFive'].' '.$data[$i]['eqSlotSix'].' '.$data[$i]['eqSlotSeven'].' '.$data[$i]['eqSlotEight'].' '.$data[$i]['maxHp'].' '.$data[$i]['maxXp'].' '.$data[$i]['boolVest'].' '.$data[$i]['banCheck'].' '.$data[$i]['banInfo'].' '.$data[$i]['nickCol'].' '.$data[$i]['team'].' '.$data[$i]['boolGuild'].' '.$data[$i]['boolHardcore'].' '.$data[$i]['guildName'].' '.$data[$i]['achivementRun'].' '.$data[$i]['boolkoparka'].' '.$data[$i]['levelkoparka'].' '.$data[$i]['collectElik'].' '.$data[$i]['collectElyk'].' '.$data[$i]['collectInfo'].' '.$data[$i]['collectEnod'].' '.$data[$i]['drivingLicence'].' '.$data[$i]['riftLevel']."\n";

    echo '<p>'.$output.'</p><br>';
    //File::write("backup.txt", $output);
    file_put_contents("backup.txt", $output, FILE_APPEND);
}
?>