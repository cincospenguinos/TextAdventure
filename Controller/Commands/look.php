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
    $thing = strtolower(str_replace('look at ', '', $command));
    $room = $player->getCurrentRoom();
    $thingDescription = null;

    if(isset($room->getAllItems()[$thing])) {
        $thingDescription = $room->getAllItems()[$thing]->getLookAtDescription();
    }

    if(is_null($thingDescription)){
        foreach($room->getAllItems() as $item)
            if($item->hasAlias($thing)) {
                $thingDescription = $item->getLookAtDescription();
                error_log("[DEBUG] Got thing from alias");
            }
    }

    if(is_null($thingDescription)){
        if(isset($room->getAllMonsters()[$thing])) {
            $thingDescription = $room->getAllMonsters()[$thing]->getDescription();
        }
    }

    if(is_null($thingDescription)){
        foreach($room->getAllMonsters() as $monster)
            if($monster->hasAlias($thing))
                $thingDescription = $monster->getDescription();
    }


    if(is_null($thingDescription))
        $data['response'] = "I don't see anything here that matches the name \"$thingDescription\".";
    else
        $data['response'] = "<div class='thing_description'>" . htmlspecialchars($thingDescription) . "</div>";

    require_once 'monster_combat.php'; // We will only trigger combat after looking at something
} else if(strcmp($command, 'look') === 0){
    $roomName = $player->getCurrentRoom()->getRoomName();
    $exits = $player->getAllExitDirections();
    $response = "<div class='room_info_header'><div class='room_name'><strong>" . htmlspecialchars($roomName) . "</strong></div><div class='exits_list'><strong>Exits: </strong>";

    foreach($exits as $exit){
        $response .= \LinkedWorldsCore\Direction::toString($exit) . ", ";
    }

    $response = trim($response, ', ');

    $room = $player->getCurrentRoom();
    $description = $room->getDescription();

    foreach($room->getAllItems() as $item) {
        if(null !== $item->getLookDescription()){
            $description .= " " . $item->getLookDescription();
        } else {
            $description .= " You see a " . strtolower($item->getName()) . " here."; // TODO: Better grammar
        }
    }

    foreach($room->getAllMonsters() as $monster) {
        if($monster->isDead())
            $description .= " There is the corpse of a " . strtolower($monster->getName()) . " here.";
        else
            $description .= " There is a " . strtolower($monster->getName()) . " here.";
    }

    $response .= "</div></div><div class='room_description'>{$description}</div>";
    $data['response'] = $response;
} else {
    $data['response'] = "I'm afraid I don't understand what you meant by \"$command\".";
}