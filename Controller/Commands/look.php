<?php
/**
 * Manages the look command in PHP. Grabs the user from APC and does all the shiz they need to.
 *
 *~ look, look [item] - describes the room or the item provided
 *# <strong>look</strong>, or <strong>look at [target]</strong> provides a description of the room or the target requested, respectively.
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
        $data['response'] = "<div class='item_description'>" . htmlspecialchars($player->lookAt($thing)) . "</div>";

    require_once 'monster_combat.php'; // We will only trigger combat after looking at something
} else if(strcmp($command, 'look') === 0){
    $roomName = $player->getCurrentRoom()->getRoomName();
    $exits = $player->getAllExitDirections();
    $description = htmlspecialchars($player->look());
    $response = "<div class='room_info_header'><div class='room_name'><strong>" . htmlspecialchars($roomName) . "</strong></div><div class='exits_list'><strong>Exits: </strong>";

    foreach($exits as $exit){
        $response .= \LinkedWorldsCore\Direction::toString($exit) . ", ";
    }

    $response = trim($response, ', ');
    $response .= "</div></div><div class='room_description'>{$description}</div>";
    $data['response'] = $response;
} else {
    $data['response'] = "I'm afraid I don't understand what you meant by \"$command\".";
}