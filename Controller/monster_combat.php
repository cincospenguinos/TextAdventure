<?php
/**
 * Manages monster attacks.
 *
 * TODO: Figure out nice output for all the combat
 * TODO: Include health information after being hit by an enemy
 *
 * User: tsvetok
 * Date: 8/2/16
 * Time: 6:52 PM
 */

// TODO: Is there a better way to manage this?

foreach($player->getCurrentRoom()->allHostileMonsters() as $monster) {
    $data['response'] .= "The " . strtolower($monster->getName()) . " attacks ";
    $roll = mt_rand(1, 20);

    if($roll <= 2){
        // TODO: Some penalty
    } else {
        $roll += $monster->physicalToHit();

        if($roll > $player->evasiveness()){

        } else {

        }
    }
}

$data['response'] .= "</div>";

// TODO: Manage death - player loses everything that is not aetherial and returns to the void, without XP