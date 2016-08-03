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
$resp = "Exits: ";

foreach($directions as $direction) {
    error_log("What the fuck man. {$direction}");
    $resp .= \LinkedWorldsCore\Direction::toString($direction) . ", ";
}

$resp = trim($resp, ', ');
$resp .= ".";

$data['response'] = $resp;

require_once 'monster_combat.php';