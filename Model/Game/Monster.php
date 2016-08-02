<?php
/**
 * Created by PhpStorm.
 * User: tsvetok
 * Date: 8/1/16
 * Time: 9:37 PM
 */

namespace LinkedWorldsCore;

require_once 'Entity.php';

class Monster extends Entity
{

    public function physicalToHit()
    {
        // TODO: Implement toHit() method.
    }

    public function takeDamage($amount)
    {
        // TODO: Implement takeDamage() method.
    }

    /**
     * Returns the amount of physical damage this entity does.
     *
     * @return integer
     */
    public function physicalDamage()
    {
        // TODO: Implement physicalDamage() method.
    }

    /**
     * Checks to see if this entity hits a spell attack on the target provided.
     *
     * @param $target
     * @return boolean
     */
    public function spellToHit($target)
    {
        // TODO: Implement spellToHit() method.
    }

    /**
     * Returns the amount of spell damage this entity does.
     *
     * @return integer
     */
    public function spellDamage()
    {
        // TODO: Implement spellDamage() method.
    }

    /**
     * Returns the evasiveness for this entity.
     *
     * @return double
     */
    public function evasiveness()
    {
        // TODO: Implement evasiveness() method.
    }

    /**
     * Returns the maximum hitpoints for this entity.
     *
     * @return integer
     */
    public function maxHitPoints()
    {
        // TODO: Implement maxHitPoints() method.
    }

    /**
     * Make an attack on a given target. Optional paramaters available if a spell is used.
     *
     * @param $target
     * @param bool $isSpell
     * @param null $spell
     * @return boolean
     */
    public function attack($target, $isSpell = false, $spell = null)
    {
        // TODO: Implement attack() method.
    }
}