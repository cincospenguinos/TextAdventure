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

$resp = $player->takeItem($item);

if($resp === true)
    $data['response'] = 'Taken.';
else
    $data['response'] = $resp;

require_once 'monster_combat.php';