<?php
/**
 * This is the endpoint file for the Controller. This file takes in all the various requests a player/client could
 * make, and then pulls together the proper scripts to accomplish the task.
 *
 * User: Andre LaFleur
 * Date: 5/25/16
 * Time: 5:22 PM
 */
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    include '../View/api.php';
    exit();
}

// Figure out what the command was
if(empty($_POST['command'])){
    echo 'NOPE';
}
$command = htmlspecialchars($_POST['command']);

// If we got this far, then the command worked out.
$data = [];
$data['result'] = 'success';

switch(true){
    case stristr($command, 'look');
        include 'look.php';
        break;
    default:
        $data['response'] = "I don't understand that. Type \"help\" for assistance.";
        break;
}

// Throw the json string back at them
$data = json_encode($data);
echo $data;