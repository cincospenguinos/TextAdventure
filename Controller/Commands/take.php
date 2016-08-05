<?php
/**
 * Manages the 'take' or 'get' command.
 *
 *~ take [item] - take an item from the current room
 *# <strong>take [item]</strong> removes the item from the current room and adds it to your inventory, if the item is available.
 *
 * User: Andre LaFleur
 * Date: 5/28/16
 * Time: 9:46 PM
 */

$command = str_replace('take ', '', $command);
$item = str_replace('get ', '', $command);

$resp = $player->takeItem($item);

if($resp === true) // Because no type checking. Gee, thanks PHP 5.6.
    $data['response'] = '<div class="response">Taken.</div>';
else
    $data['response'] = $resp;

require_once 'monster_combat.php';