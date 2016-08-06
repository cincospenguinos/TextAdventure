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
require_once '../Model/Game/CombatManager.php';

$monsterName = str_replace('attack ', '', $command);
$monsterName = str_replace('kill ', '', $monsterName);
$monster = $player->getCurrentRoom()->getMonster($monsterName);

$data['response'] = '<div class="combat_response">';

// Now that we have everything we need, we can go ahead and manage the combat system here.
if(isset($monster)){
    $result = \LinkedWorldsCore\CombatManager::attack($player, $monster);

    switch($result){
        case \LinkedWorldsCore\CombatManager::AttackerDisarmed:
            $data['response'] .= "The " . strtolower($monster->getName()) . " swiftly knocks your weapon out of your hands and onto the ground. ";
            break;
        case \LinkedWorldsCore\CombatManager::DefaultMiss:
            $data['response'] .= "The " . strtolower($monster->getName()) . " dodged your attack. ";
            break;
        case \LinkedWorldsCore\CombatManager::DefaultHit:
            $data['response'] .= "You hit the " . strtolower($monsterName) . ". ";
            break;
        case \LinkedWorldsCore\CombatManager::CriticalHit:
            $data['response'] .= "Critical hit! $monsterName is reeling! ";
            break;
    }

    if($monster->isDead())
        $data['response'] .= $monster->getName() . " was killed! ";

    include 'monster_combat.php';
} else {
    $data['response'] .= 'I cannot find that target here.</div>';
}