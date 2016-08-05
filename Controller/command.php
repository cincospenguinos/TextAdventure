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
require_once '../Model/Parser.php';
require_once '../Model/Game/Player.php';
require_once '../Model/Game/Direction.php';
require_once '../Model/Game/Room.php';

// TODO: Set a different endpoint for commands in the void? Like maybe a different set of commands?

// If there is ever a GET request, just show the API page.
if($_SERVER['REQUEST_METHOD'] === 'GET') {
    include '../View/api.php';
    exit();
}

// If a command was not sent, then respond indicating that is the case
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
if(!isset($_SESSION[$username])) {
    $_SESSION[$username] = UserManager::generateNewPlayer($username);
    $_SESSION['command_count'] = 0;
}

// If we got this far, we have a legit command and response. So increment the command count
$_SESSION['command_count'] += 1;

// Get the player object out of the session
$player = $_SESSION[$username];
$data = [];

$archCommand = Parser::getArchCommand($command);

if(is_null($archCommand))
    $data['response'] = "<div class='misunderstand_response'>I'm afraid I don't understand. Type the command \"<strong>help</strong>\" for a list of commands.</div>";
else
    include 'Commands/' . $archCommand . '.php';

// Throw the json string back at them
$data['result'] = 'success';
$data['response'] = "<div class='response' id='response{$_SESSION['command_count']}'><span class='command_prompt_span'>&gt;</span>{$command}<br/>" . $data['response'] . "</div>";
$data = json_encode($data);
echo $data;