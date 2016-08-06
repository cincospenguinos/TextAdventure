<?php
/**
 * Created by PhpStorm.
 * User: tsvetok
 * Date: 8/6/16
 * Time: 9:18 AM
 */

namespace LinkedWorldsCore;

/**
 * Class that manages all attacks and stuff. Meant to reduce the duplicated code.
 *
 * @package LinkedWorldsCore
 */
abstract class AttackManager
{
    // The possible outcomes from combat
    const AttackerDisarmed = 0;
    const DefaultMiss = 1;
    const DefaultHit = 2;
    const DefenderDisarmed = 3;
    const CriticalHit = 4;

    public static function attack($attacker, $defender, $isSpell = false, $spell = null){
        $roll = mt_rand(1, 20);

        switch($roll){
//            case 1: TODO: Manage disarming - weapons are needed first
//            case 2:
//                return AttackManager::AttackerDisarmed;
//            case 18:
//            case 19:
//                return AttackManager::DefenderDisarmed;
            case 20:
                return AttackManager::CriticalHit;
            default:
                return AttackManager::DefaultHit;
        }
    }
}