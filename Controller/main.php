<?php
/**
 * This is the endpoint file for the Controller. This file takes in all the various requests a player/client could
 * make, and then pulls together the proper scripts to accomplish the task.
 *
 * User: Andre LaFleur
 * Date: 5/25/16
 * Time: 5:22 PM
 */
require_once '../dbconfig.php';
require_once '../Model/UserManager.php';
require_once '../Model/Game/Player.php';
require_once '../Model/Game/Direction.php';

// If there is ever a GET request, just show the API page.
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    include '../View/api.php';
    exit();
}

// If a command was not sent, then respond indicating that
if(empty($_POST['command'])) {
    $data['result'] = 'failure';
    $data['response'] = 'No command was provided!';
    $data = json_encode($data);
    echo $data;
    exit();
}

// If we didn't get a username, then indicate that that was needed
if(empty($_POST['username'])){
    $data['result'] = 'failure';
    $data['response'] = 'Username was not included in the request!';
    $data = json_encode($data);
    echo $data;
    exit;
}

// At this point, the user obviously sent us a command, so we should get that crap figured out
session_start();

// Get the player name and the command
$username = htmlspecialchars($_POST['username']);
$command = htmlspecialchars($_POST['command']);

// If there isn't a player associated with this session, then we need to put him in there.
if(!isset($_SESSION[$username])){
    $_SESSION[$username] = UserManager::generateNewPlayer($username);
}

// Get the player object out of the session
$player = $_SESSION[$username];
$data = [];

switch(true){
    case stristr($command, 'look'):
        include 'Commands/look.php';
        break;
    case stristr($command, 'login'):
        include 'Commands/login.php';
        break;
    case stristr($command, 'help'):
        include 'Commands/help.php';
        break;
    case stristr($command, 'go'):
    case \LinkedWorldsCore\Direction::isDirectionString($command):
        include 'Commands/go.php';
        break;
    default:
        $data['response'] = "I don't understand that. Type \"help\" for assistance.";
        break;
}

// Throw the json string back at them
$data['result'] = 'success';
$data = json_encode($data);
echo $data;