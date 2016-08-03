<?php
/**
 * Manages the drop command for the game.
 *
 *~ drop [item] - drops an item you are carrying
 *
 * User: Andre LaFleur
 * Date: 5/28/16
 * Time: 10:19 PM
 */

$item = str_replace('drop ', '', $command);

if($player->dropItem($item))
    $data['response'] = 'Dropped.';
else
    $data['response'] = 'You are not currently carrying that item.';

require_once 'monster_combat.php';