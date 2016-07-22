<?php
/**
 * Shows the exits for the current room
 *
 *~ show all exits from current room
 *
 * Created by PhpStorm.
 * User: tsvetok
 * Date: 7/21/16
 * Time: 9:43 PM
 */

$directions = $player->getCurrentRoom()->getAllExitDirections();
$resp = "Exit(s) are ";

for($i = 0; $i < sizeof($directions) - 1; $i += 1)
    $resp .= \LinkedWorldsCore\Direction::toString($i) . ", ";

$resp .= \LinkedWorldsCore\Direction::toString($directions[sizeof($directions) - 1]) . ".";
$data['response'] = $resp;