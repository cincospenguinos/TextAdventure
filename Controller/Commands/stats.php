<?php
/**
 * Stats command shows the "stats" of a given item, or of the player.
 *
 *~ show the stats of yourself or of an item
 *# <strong>stats</strong> shows your stats, while <strong>stats [item]</strong> shows stats on a specific item.
 *
 * User: tsvetok
 * Date: 8/7/16
 * Time: 8:50 AM
 */
require_once '../Model/Game/Attribute.php';

$statsCommand = explode(' ', $command);
$data['response'] .= '<div class="stats_response">';

if(sizeof($statsCommand) === 1){
    $data['response'] .= '<div class="player_attributes"><div class="player_independent_attributes"><table>';
    $data['response'] .= '<tr><td>Strength</td><td>' . $player->getStrength() .'</td></tr>';
    $data['response'] .= '<tr><td>Constitution</td><td>' . $player->getConstitution() .'</td></tr>';
    $data['response'] .= '<tr><td>Dexterity</td><td>' . $player->getDexterity() .'</td></tr>';
    $data['response'] .= '<tr><td>Intelligence</td><td>' . $player->getIntelligence() .'</td></tr>';
    $data['response'] .= '</table></div><div class="player_dependent_attributes"><table>';
    $data['response'] .= '<tr><td>Physical To-Hit</td><td>' . $player->physicalToHit() . '</td>';
    $data['response'] .= '<tr><td>Physical Damage</td><td>' . $player->physicalDamage() . '</td>';
    $data['response'] .= '<tr><td>Spell To-Hit</td><td>' . $player->spellToHit() . '</td>';
    $data['response'] .= '<tr><td>Spell Damage</td><td>' . $player->spellDamage() . '</td>';
    $data['response'] .= '<tr><td>Evasiveness</td><td>' . $player->evasiveness() . '</td>';
    $data['response'] .= '<tr><td>Max Hit Points</td><td>' . $player->maxHitPoints() . '</td>';
    $data['response'] .= '</table></div></div>';
} else if(sizeof($statsCommand) === 2){
    $thing = $player->getItem($statsCommand[1]);

    if(is_null($thing))
        $thing = $player->getCurrentRoom()->getItem($statsCommand[1]);

    if(!is_null($thing)) {
        $data['response'] .= 'Stats:<br/><ul class="item_stats">';

        foreach($thing->getItemModifiers() as $attribute => $modifier){
            $data['response'] .= "<li>" . \LinkedWorldsCore\Attribute::toString($attribute);

            if($modifier > 0){
                $data['response'] .= ": +$modifier</li>";
            } else {
                $data['response'] .= ": $modifier</li>";
            }
        }

        $data['response'] .= '</ul>';
    } else {
        // The thing is nowhere to be found
        $data['response'] .= 'I do not see that item here.';
    }
} else {
    $data['response'] .= 'I am afraid I do not understand.';
}

$data['response'] .= '</div>';