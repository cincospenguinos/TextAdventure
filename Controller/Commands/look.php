<?php
/**
 * Manages the look command in PHP. Grabs the user from APC and does all the shiz they need to.
 *
 * User: Andre LaFleur
 * Date: 5/25/16
 * Time: 9:53 PM
 */

if(strpos($command, 'look at') !== false) {
    $item = str_replace('look at ', '', $command);
    $response = $player->lookAt($item);

    if(is_null($response))
        $data['response'] = "I don't see anything here that matches the name \"$item\".";
    else
        $data['response'] = htmlspecialchars($player->lookAt($item));
} else if(strcmp($command, 'look') === 0){
    $data['response'] = htmlspecialchars($player->look());
} else {
    $data['response'] = "I'm afraid I don't understand what you meant by \"$command\".";
}