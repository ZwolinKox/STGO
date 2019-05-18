<?php

class Guild {

    

    private function __construct() {

    }

    static public function getIdMemberFromNumber($memberNumber)
    {
        $guildName = DatabaseManager::selectBySQL("SELECT guildName FROM users WHERE id=".$_SESSION['uid'])[0]['guildName'];
        $guildInfo =  DatabaseManager::selectBySQL("SELECT * FROM guilds WHERE guildName='".$guildName."'")[0];

        return $guildInfo[$memberNumber];
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

    static public function deleteGuildMemberById($member)
    {
        $guildName = DatabaseManager::selectBySQL("SELECT guildName FROM users WHERE id=".$_SESSION['uid'])[0]['guildName'];

        $memberId = $member;

        $member = self::getMemberNumberFromId($memberId);
        //$guildInfo[$member] = 0;


        DatabaseManager::updateTable("users", ["guildName" => '""', "boolGuild" => "0"], ["id" => $memberId]);
        DatabaseManager::updateTable("guilds", [$member => 0], ["guildName" => '"'.$guildName.'"']);

    }

    static public function deleteGuild()
    {
        $guildName = DatabaseManager::selectBySQL("SELECT guildName FROM users WHERE id=".$_SESSION['uid'])[0]['guildName'];
        if(DatabaseManager::selectBySQL('SELECT guildOwner FROM guilds WHERE guildName="'.$guildName.'"')[0]['guildOwner'] == $_SESSION['uid'])
        {
            DatabaseManager::updateTable("users", ["guildName" => '""', "boolGuild" => "0"], ["id" => self::getIdMemberFromNumber('guildMemberTwo')]);
            DatabaseManager::updateTable("users", ["guildName" => '""', "boolGuild" => "0"], ["id" => self::getIdMemberFromNumber('guildMemberThree')]);
            DatabaseManager::updateTable("users", ["guildName" => '""', "boolGuild" => "0"], ["id" => self::getIdMemberFromNumber('guildMemberFour')]);
            DatabaseManager::updateTable("users", ["guildName" => '""', "boolGuild" => "0"], ["id" => self::getIdMemberFromNumber('guildMemberFive')]);
            DatabaseManager::updateTable("users", ["guildName" => '""', "boolGuild" => "0"], ["id" => self::getIdMemberFromNumber('guildMemberSix')]);
            DatabaseManager::updateTable("users", ["guildName" => '""', "boolGuild" => "0"], ["id" => self::getIdMemberFromNumber('guildMemberSeven')]);
            DatabaseManager::updateTable("users", ["guildName" => '""', "boolGuild" => "0"], ["id" => self::getIdMemberFromNumber('guildMemberEight')]);
            DatabaseManager::updateTable("users", ["guildName" => '""', "boolGuild" => "0"], ["id" => self::getIdMemberFromNumber('guildMemberNine')]);
            DatabaseManager::updateTable("users", ["guildName" => '""', "boolGuild" => "0"], ["id" => self::getIdMemberFromNumber('guildMemberTen')]);
            DatabaseManager::updateTable("users", ["guildName" => '""', "boolGuild" => "0"], ["id" => $_SESSION['uid']]);
            DatabaseManager::deleteFrom('guilds', ['guildName' => $guildName]);

        }
    }


    static public function leaveGuild()
    {
        $guildName = DatabaseManager::selectBySQL("SELECT guildName FROM users WHERE id=".$_SESSION['uid'])[0]['guildName'];
        if(DatabaseManager::selectBySQL('SELECT guildOwner FROM guilds WHERE guildName="'.$guildName.'"')[0]['guildOwner'] != $_SESSION['uid'])
        {
            $memberNumber = self::getMemberNumberFromId($_SESSION['uid']);
            DatabaseManager::updateTable("users", ["guildName" => '""', "boolGuild" => "0"], ["id" => $_SESSION['uid']]);
            DatabaseManager::updateTable("guilds", [$memberNumber => 0], ["guildName" => '"'.$guildName.'"']);
        }
    }


    static public function deleteGuildMemberByNumber($member)
    {
        $guildName = DatabaseManager::selectBySQL("SELECT guildName FROM users WHERE id=".$_SESSION['uid'])[0]['guildName'];

        //$guildInfo[$member] = 0;
        $memberId = self::getIdMemberFromNumber($member); 

        DatabaseManager::updateTable("users", ["guildName" => '""', "boolGuild" => "0"], ["id" => $memberId]);
        DatabaseManager::updateTable("guilds", [$member => 0], ["guildName" => '"'.$guildName.'"']);
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