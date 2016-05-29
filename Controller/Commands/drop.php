<?php
/**
 * Manages the drop command for the game.
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