<?php
/**
 * Created by PhpStorm.
 * User: tsvetok
 * Date: 6/9/16
 * Time: 12:31 PM
 */

namespace LinkedWorldsCore;

/**
 * Class that manages the attribute scores for the game. Basically an enum with an extra function or two.
 *
 * @package LinkedWorldsCore
 */
abstract class Attribute
{
    const Strength = 0;
    const Constitution = 1;
    const Dexterity = 2;
    const Intelligence = 3;
    const PhysicalDamage = 4;
    const MaxHitPoints = 5;
    const SpellToHit = 6;
    const PhysicalToHit = 7;
    const Evasiveness = 8;
    const SpellDamage = 9;

    /**
     * Returns the modifier of the score passed
     *
     * @param $attributeScore
     * @return int
     */
    public static function getModifier ($attributeScore) {
        return round((($attributeScore - 6) / 2)) * 1;
    }
}