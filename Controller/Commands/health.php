<?php
/**
 * Indicates to the user how much health he or she has
 *
 *~ Describes your current health condition
 *# <strong>health</strong> describes how you are currently feeling in regards to your health.
 *
 * User: tsvetok
 * Date: 8/5/16
 * Time: 6:49 AM
 */

$data['response'] = '<div class="player_health_response">';

$currentHP = $player->getCurrentHitPoints();
$maxHP = $player->maxHitPoints();
$ratio = ($currentHP * 1.0) / ($maxHP * 1.0);

if($ratio === 1.0)
    $data['response'] .= 'You feel like you\'re in perfect health.';
else if($ratio > 0.9)
    $data['response'] .= 'You have a few small scratches.';
else if($ratio > 0.75)
    $data['response'] .= 'You feel that you\'ve taken a couple minor injuries.';
else if($ratio > 0.4)
    $data['response'] .= 'You have some major injuries that need to be addressed.';
else if ($ratio > 0.25)
    $data[] .= 'You are seriously struggling to move.';
else
    $data['response'] .= 'You feel weak and frail, on the verge of death.';

$data['response'] .= '</div>';