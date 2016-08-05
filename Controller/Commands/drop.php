<?php
/**
 * Manages the drop command for the game.
 *
 *~ drop [item] - drops an item you are carrying
 *# <strong>drop [item]</strong> will drop whatever item you are carrying that matches that name
 *
 * User: Andre LaFleur
 * Date: 5/28/16
 * Time: 10:19 PM
 */

$item = str_replace('drop ', '', $command);

if($player->dropItem($item))
    $data['response'] = '<div class=dropped_response>Dropped.</div>';
else
    $data['response'] = '<div class=dropped_response>You are not currently carrying that item.</div>';

require_once 'monster_combat.php';