<?php
/**
 * Script managing going in some direction.
 *
 *~ go [direction] - moves you to the direction provided
 * User: tsvetok
 * Date: 5/28/16
 * Time: 4:04 PM
 */

$command = trim(str_replace('go', '', $command));

if(\LinkedWorldsCore\Direction::isDirectionString($command)){
    $direction = \LinkedWorldsCore\Direction::toDirection($command);

    if($player->goDirection($direction)){
        // We're going to throw the look command down now, as that will make us avoid adding extra code
        $command = 'look';
        include 'look.php';
    } else {
        $data['response'] = 'There is no exit that direction.';
    }
} else {
    $data['response'] = 'I do not understand that.';
}