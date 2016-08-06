<?php
/**
 * Manages all of the combat.
 *
 *~ attack [target] - attack the target provided.
 *# <strong>attack [target]</strong> will throw a physical attack at the target provided.
 *
 * TODO: Figure out nice output for all the combat
 * TODO: Disarming? Penalties on low rolls?
 * TODO: Move attack method code out into the controller
 * TODO: Add multiple strings to describe the action, rather than "so and so was hit"
 * TODO: Smarter AI - if the AI drops its weapon, it picks it up. If the player drops its weapon, the AI picks it up.
 */
$monsterName = str_replace('attack ', '', $command);
$monsterName = str_replace('kill ', '', $monsterName);
$monster = $player->getCurrentRoom()->getMonster($monsterName);

if(isset($monster)){
    if($player->attack($monster)){
        $data['response'] = $monster->getName() . ' was hit! ';

        if($monster->takeDamage($player->physicalDamage()))
            $data['response'] = $monster->getName() . ' was killed!';
    } else {
        $data['response'] = $monsterName . ' dodged the attack.';
    }

    require_once 'monster_combat.php';
} else {
    $data['response'] = 'I cannot find that monster there.';
}