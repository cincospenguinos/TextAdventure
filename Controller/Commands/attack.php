<?php
/**
 * Manages all of the combat.
 *
 *~ attack [target] - attack the target provided.
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
} else {
    $data['response'] = 'I cannot find that monster there.';
}

require_once 'monster_combat.php';