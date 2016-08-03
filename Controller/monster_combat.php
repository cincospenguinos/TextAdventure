<?php
/**
 * Manages monster attacks.
 *
 * User: tsvetok
 * Date: 8/2/16
 * Time: 6:52 PM
 */
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

// TODO: What happens at death, especially during the tutorial dungeon? Do we set you up to go back to the beginning?