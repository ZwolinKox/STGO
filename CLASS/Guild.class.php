<?php

class Guild {

    

    private function __construct() {

    }

    static public function getMemberNumberFromId($memberId)
    {
        $guildName = DatabaseManager::selectBySQL("SELECT guildName FROM users WHERE id=".$_SESSION['uid'])[0]['guildName'];
        $guildInfo =  DatabaseManager::selectBySQL("SELECT * FROM guilds WHERE guildName='".$guildName."'")[0];

        if($guildInfo['guildMemberTwo'] == $memberId)
            return 'guildMemberTwo';


        if($guildInfo['guildMemberThree'] == $memberId)
            return 'guildMemberThree';

        if($guildInfo['guildMemberFour'] == $memberId) 
            return 'guildMemberFour';

        if($guildInfo['guildMemberFive'] == $memberId) 
            return 'guildMemberFive';

        if($guildInfo['guildMemberSix'] == $memberId) 
            return 'guildMemberSix';

        if($guildInfo['guildMemberSeven'] == $memberId) 
            return 'guildMemberSeven';

        if($guildInfo['guildMemberEight'] == $memberId) 
            return 'guildMemberEight';

        if($guildInfo['guildMemberNine'] == $memberId) 
            return 'guildMemberNine';

        if($guildInfo['guildMemberTen'] == $memberId) 
            return 'guildMemberTen';

        if($guildInfo['guildOwner'] == $memberId) 
            return 'guildOwner';
    }

    static public function getGuildMemberStat($member, $stat)
    {
        $guildName = DatabaseManager::selectBySQL("SELECT guildName FROM users WHERE id=".$_SESSION['uid'])[0]['guildName'];
        return DatabaseManager::selectBySQL("SELECT users.$stat FROM users, guilds WHERE guilds.guildName = '$guildName' AND users.id=guilds.".self::getMemberNumberFromId($member))[0][$stat]; 
    }

    static public function getGuildMember($member)
    {
        $guildName = DatabaseManager::selectBySQL("SELECT guildName FROM users WHERE id=".$_SESSION['uid'])[0]['guildName'];
        return DatabaseManager::selectBySQL("SELECT users.* FROM users, guilds WHERE guilds.guildName = '$guildName' AND users.id=guilds.".self::getMemberNumberFromId($member))[0]; 
    }
}