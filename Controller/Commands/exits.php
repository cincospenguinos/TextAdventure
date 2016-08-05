<?php
/**
 * Shows the exits for the current room
 *
 *~ show all exits from current room
 *# <strong>exits</strong> will simply list all of the available exits from the current space.
 *
 * Created by PhpStorm.
 * User: tsvetok
 * Date: 7/21/16
 * Time: 9:43 PM
 */

$directions = $player->getAllExitDirections();
$resp = "Exits: ";

foreach($directions as $direction) {
    $resp .= \LinkedWorldsCore\Direction::toString($direction) . ", ";
}

$resp = trim($resp, ', ');
$resp .= ".";

$data['response'] = "<div class='exits_response'>{$resp}</div>";

require_once 'monster_combat.php';