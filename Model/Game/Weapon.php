<?php
/**
 * Created by PhpStorm.
 * User: tsvetok
 * Date: 8/6/16
 * Time: 9:30 AM
 */

namespace LinkedWorldsCore;

require_once 'Item.php';

class Weapon extends Item
{
    // TODO: What about extensions? Like adding gems to items to give them certain traits?
    // TODO: What about "leveling" items up? Should that be an option?
    private $handSlots, $damageAmount, $damageType;

    /**
     * Weapon constructor.
     * @param $_weaponName - name of weapon
     * @param $_lookAtDescription - what is shown when the player looks at the weapon
     * @param null $_lookDescription - what is shown when the weapon is sitting in the room
     * @param $_damageAmount - how many "rolls" this weapon should make
     * @param $_damageType - what kind of "roll" this weapon should make
     * @param $_handSlots - the number of "hand slots" this weapon takes (1 or 2)
     * @param $_aetherial - whether or not this item is aetherial
     */
    public function __construct($_weaponName, $_lookAtDescription, $_damageAmount, $_damageType, $_handSlots, $_lookDescription = null, $_aetherial = false)
    {
        parent::__construct($_weaponName, $_lookAtDescription, $_lookDescription, true, true, $_aetherial);

        $this->handSlots = $_handSlots;
        $this->damageAmount = $_damageAmount;
        $this->damageType = $_damageType;
    }

    /**
     * Returns the number of hand slots that this weapon takes up.
     *
     * @return int
     */
    public function getHandSlots(){
        return $this->handSlots;
    }

    /**
     * Rolls up the amount of damage of this weapon.
     *
     * @return int
     */
    public function rollDamage(){
        $damage = 0;
        $counter = 0;

        while ($counter < $this->damageAmount){
            $damage += mt_rand(1, $this->damageType);
            $counter += 1;
        }


        return $damage;
    }

    /**
     * Returns the maximum amount of damage this weapon can do.
     *
     * @return int
     */
    public function getMaxDamage(){
        return $this->damageAmount + $this->damageType;
    }
}