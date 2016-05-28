<?php
/**
 * This is the endpoint file for the Controller. This file takes in all the various requests a player/client could
 * make, and then pulls together the proper scripts to accomplish the task.
 *
 * User: Andre LaFleur
 * Date: 5/25/16
 * Time: 5:22 PM
 */
//session_start();

include_once '../dbconfig.php';
require_once '../Model/UserManager.php';
require_once '../Model/User.php';

// If there is ever a GET request, just show the API page.
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    include '../View/api.php';
    exit();
}

// Figure out what the command was
if(empty($_POST['command'])) {
    $data = [];
    $data['result'] = 'failure';
    $data['response'] = 'No command was provided!';
    $data = json_encode($data);
    echo $data;
    exit();
}

$user = null;

$dbConnection = getDBConnection();
echo UserManager::createNewUser($dbConnection);

// TODO: Figure out user stuff
if(isset($_SESSION['username'])){
    // A user exists - let's pull them up and mess with them
} else {
    // This is the user's first time on the page! Let's create a user account for them and store it away.
}


$command = htmlspecialchars($_POST['command']);

// If we got this far, then the command worked out.
$data = [];
$data['result'] = 'success';

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
    default:
        $data['response'] = "I don't understand that. Type \"help\" for assistance.";
        break;
}

// Throw the json string back at them
$data = json_encode($data);
echo $data;