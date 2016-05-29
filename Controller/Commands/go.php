<?php
/**
 * Script managing going in some direction.
 *
 * User: tsvetok
 * Date: 5/28/16
 * Time: 4:04 PM
 */
// TODO: Figure out why certain directions aren't allowed

$command = trim(str_replace('go', '', $command));

if(\LinkedWorldsCore\Direction::isDirectionString($command)){
    $direction = \LinkedWorldsCore\Direction::toDirection($command);

    if($player->goDirection($direction)){
        $data['response'] = $player->look();
    } else {
        $data['response'] = 'There is no exit that direction.';
    }
} else {
    $data['response'] = 'I do not understand that.';
}