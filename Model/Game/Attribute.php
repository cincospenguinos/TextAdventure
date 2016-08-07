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
        if($attributeScore == 0)
            return -3;

        return round(($attributeScore - 5) / 2, 0, PHP_ROUND_HALF_DOWN);
    }

    /**
     * When given an attribute, returns a string of that specific attribute, or null if the number provided is not
     * an attribute.
     *
     * @param $attribute
     * @return null|string
     */
    public static function toString ($attribute){
        switch($attribute){
            case Attribute::Strength:
                return 'Strength';
            case Attribute::Constitution:
                return 'Constitution';
            case Attribute::Dexterity:
                return 'Dexterity';
            case Attribute::Intelligence:
                return 'Intelligence';
            case Attribute::PhysicalDamage:
                return 'Physical Damage';
            case Attribute::MaxHitPoints:
                return 'Max Hit Points';
            case Attribute::SpellToHit:
                return 'Spell To-Hit';
            case Attribute::PhysicalToHit:
                return 'Physical To-Hit';
            case Attribute::Evasiveness:
                return 'Evasiveness';
            case Attribute::SpellDamage:
                return 'Spell Damage';
            default:
                return null;
        }
    }
}