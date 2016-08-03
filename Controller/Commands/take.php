<?php
/**
 * Manages the 'take' or 'get' command.
 *
 *~ take [item] - take an item from the current room
 *
 * User: Andre LaFleur
 * Date: 5/28/16
 * Time: 9:46 PM
 */

$command = str_replace('take ', '', $command);
$item = str_replace('get ', '', $command);

if($player->takeItem($item))
    $data['response'] = 'Taken.';
else
    $data['response'] = "I couldn't find the thing \"$item\" here.";

require_once 'monster_combat.php';