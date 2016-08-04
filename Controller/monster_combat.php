<?php
/**
 * Manages monster attacks.
 *
 * User: tsvetok
 * Date: 8/2/16
 * Time: 6:52 PM
 */

// TODO: Is there a better way to manage this

foreach($player->getCurrentRoom()->allHostileMonsters() as $monster) {
    $data['response'] .= "<br/>The " . strtolower($monster->getName()) . " attacks ";

    if($monster->attack($player)){
        $data['response'] .= "and it hit!";

        if($player->takeDamage($monster->physicalDamage())) {
            $data['response'] .= " And you're super dead!";
            break;
        }
    } else {
        $data['response'] .= "and it missed.";
    }
}

// TODO: Manage death - player loses everything that is not aetherial and returns to the void, without XP