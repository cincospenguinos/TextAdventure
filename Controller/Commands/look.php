<?php
/**
 * Manages the look command in PHP. Grabs the user from APC and does all the shiz they need to.
 *
 *~ look, look [item] - describes the room or the item provided
 *
 * TODO: THIS COMMAND REQUIRES COMBAT!
 *
 * User: Andre LaFleur
 * Date: 5/25/16
 * Time: 9:53 PM
 */

if(strpos($command, 'look at') !== false) {
    $thing = str_replace('look at ', '', $command);
    $response = $player->lookAt($thing);

    if(is_null($response))
        $data['response'] = "I don't see anything here that matches the name \"$thing\".";
    else
        $data['response'] = "<p>" . htmlspecialchars($player->lookAt($thing)) . "</p>";
} else if(strcmp($command, 'look') === 0){
    $roomName = $player->getCurrentRoomName();
    $description = $player->look();
    $data['response'] = "<strong>" . htmlspecialchars($roomName) . "</strong><br/><br/>" .  htmlspecialchars($description);
} else {
    $data['response'] = "I'm afraid I don't understand what you meant by \"$command\".";
}