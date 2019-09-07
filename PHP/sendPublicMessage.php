<?php

function colorByTeam($id) {
    switch ($id) {
        case '1':
        return '#ffcd2b';
        break;
        case '2':
        return '#ff1616';
        break;
        case '3':
        return '#42c5f4';
        break;
        
    }
}

require_once 'config.php';

if(Post::get('co') == 'sendMessage') {
    DatabaseManager::insertInto('messages', ['fromId' => $_SESSION['uid'], 'mess' => strip_tags(Post::get('message'))]);
}

elseif (Post::get('co') == 'recMessage') {
    $messages = DatabaseManager::selectBySQL('SELECT * FROM messages ORDER BY id DESC LIMIT 10');

    $length = count($messages);

    for ($i = 0; $i < $length; $i++) {
        $messages[$i]['nick'] = DatabaseManager::selectBySQL('SELECT username FROM users WHERE id='.$messages[$i]['fromId'])[0]['username'];

        $team = DatabaseManager::selectBySQL('SELECT team FROM users WHERE id='.$messages[$i]['fromId'])[0]['team'];
        $messages[$i]['color'] = colorByTeam($team);


    }

    die(json_encode($messages));
}