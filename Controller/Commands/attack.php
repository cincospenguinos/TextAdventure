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

$data['response'] = '<div class="combat_response">';

// Now that we have everything we need, we can go ahead and manage the combat system here.
if(isset($monster)){
    $roll = mt_rand(1, 20);

    if($roll <= 2){
        // TODO: Disarm, trip, something bad happens
    } else {
        $roll +=  $player->physicalToHit();

        if ($roll > $monster->evasiveness()){
            $data['response'] .= "You hit " . strtolower($monsterName) . ". ";
            $monster->takeDamage($player->physicalDamage());
            error_log("[DEBUG] Monster HP: " . $monster->getCurrentHitPoints());
        } else {
            $data['response'] .= "$monsterName dodged your attack.";
        }
    }

    include 'monster_combat.php';
} else {
    $data['response'] .= 'I cannot find that target here.';
}