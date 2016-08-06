<?php
/**
 * Takes the item requested by the player and causes the player to equip it.
 *
 *~ equip [item] - equip an item you are currently carrying
 *# <strong>equip</strong>s the item requested. Any item that is equipped adds its modifier stats to your stats.
 * User: tsvetok
 * Date: 8/6/16
 * Time: 3:19 PM
 */
$data['response'] .= '<div class="equip_response">';
$itemName = str_replace('equip ', '', $command);
$result = $player->equip($itemName);

if(is_string($result)){
    $data['response'] .= $result;
} else {
    $data['response'] .= "Equipped.";
}

include 'monster_combat.php';