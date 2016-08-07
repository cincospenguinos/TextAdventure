<?php
/**
 * Manages monster attacks.
 *
 * User: tsvetok
 * Date: 8/2/16
 * Time: 6:52 PM
 */
require_once '../Model/Game/CombatManager.php';

foreach($player->getCurrentRoom()->allHostileMonsters() as $monster) {
    $data['response'] .= "The " . strtolower($monster->getName()) . " attacks ";
    $result = \LinkedWorldsCore\CombatManager::attack($monster, $player); // TODO: Casting spells?

    switch($result){
        case \LinkedWorldsCore\CombatManager::AttackerDisarmed:
            $data['response'] .= " and you parried.";
            break;
        case \LinkedWorldsCore\CombatManager::DefaultMiss:
            $data['response'] .= " and misses.";
            break;
        case \LinkedWorldsCore\CombatManager::DefaultHit:
            $data['response'] .= "and hits!";
            break;
        case \LinkedWorldsCore\CombatManager::CriticalHit:
            $data['response'] .= "and scores a critical hit!";
            break;
    }

    if($player->isDead()){
        // TODO: Manage death - player loses everything that is not aetherial and returns to the void, without XP
        $data['response'] .= ' You are super dead.';
    }
}

$data['response'] .= "</div>";