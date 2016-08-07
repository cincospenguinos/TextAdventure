<?php
/**
 * Created by PhpStorm.
 * User: tsvetok
 * Date: 8/6/16
 * Time: 9:18 AM
 */

namespace LinkedWorldsCore;

require_once 'Entity.php';

/**
 * Class that manages all attacks and stuff. Meant to reduce the duplicated code.
 *
 * @package LinkedWorldsCore
 */
abstract class CombatManager
{
    // The possible outcomes from combat
    const AttackerDisarmed = 0;
    const DefaultMiss = 1;
    const DefaultHit = 2;
    const DefenderDisarmed = 3;
    const CriticalHit = 4;

    /**
     * Makes a single attack from the attacker provided to the defender. Manages spell attacks
     * as well as physical ones, but defaults to physical attacks. Returns an integer representing
     * the outcome to the attack itself.
     *
     * @param $attacker
     * @param $defender
     * @param bool $isSpell
     * @param null $spell
     * @return int
     */
    public static function attack($attacker, $defender, $isSpell = false, $spell = null){
        $roll = mt_rand(1, 20);

        switch($roll){
//            case 1:
//            case 2:
//                // TODO: Manage disarming - how do?
//                return CombatManager::AttackerDisarmed;
//            case 18:
//            case 19:
//                return CombatManager::DefenderDisarmed;
            case 20:
                $isSpell === true ? $defender->takeDamage($attacker->maxSpellDamage()) : $defender->takeDamage($attacker->maxPhysicalDamage());
                return CombatManager::CriticalHit;
            default:
                if($isSpell === true)
                    $roll += $attacker->spellToHit();
                else
                    $roll += $attacker->physicalToHit();

                if($roll > $defender->evasiveness()){
                    $isSpell === true ? $defender->takeDamage($attacker->rollSpellDamage()) : $defender->takeDamage($attacker->rollPhysicalDamage());
                    return CombatManager::DefaultHit;
                } else
                    return CombatManager::DefaultMiss;
        }
    }
}