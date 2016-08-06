<?php
/**
 * Created by PhpStorm.
 * User: tsvetok
 * Date: 6/9/16
 * Time: 1:13 PM
 */

namespace LinkedWorldsCore;


abstract class Entity
{
    // TODO: Spells?
    // TODO: Make an inventory class and include it here - Inventory can be used to manage weight - maybe do this.
    // TODO: Equippables at top level?
    // TODO: Let's migrate over to a d20 based system instead of this janky one.
    protected $attributes = [0, 0, 0, 0];
    protected $currentHitPoints, $isDead, $level;

    /**
     * Checks to see if this entity hits a physical attack on the target provided.
     *
     * @param $target
     * @return boolean
     */
    public abstract function physicalToHit();

    /**
     * Returns the amount of physical damage this entity does.
     *
     * @return integer
     */
    public abstract function physicalDamage();

    /**
     * Get the spell to hit score.
     *
     * @return boolean
     */
    public abstract function spellToHit();

    /**
     * Returns the amount of spell damage this entity does.
     *
     * @return integer
     */
    public abstract function spellDamage();

    /**
     * Returns the evasiveness for this entity.
     *
     * @return double
     */
    public abstract function evasiveness();

    /**
     * Returns the maximum hitpoints for this entity.
     *
     * @return integer
     */
    public abstract function maxHitPoints();

    /**
     * Applies the damage amount provided to this entity. Returns true if this entity is dead.
     *
     * @param $amount
     * @param boolean
     */
    public function takeDamage($amount){
        $this->currentHitPoints -= $amount;
        $this->isDead = $this->currentHitPoints < 0;

        return $this->isDead;
    }

    /**
     * @return mixed
     */
    public function getStrength()
    {
        return $this->attributes[Attribute::Strength];
    }

    /**
     * @param $strength
     */
    public function setStrength($strength){
        $this->attributes[Attribute::Strength] = $strength;
    }

    /**
     * @return mixed
     */
    public function getConstitution()
    {
        return $this->attributes[Attribute::Constitution];
    }

    /**
     * @param $constitution
     */
    public function setConstitution($constitution){
        $this->attributes[Attribute::Strength] = $constitution;
    }

    /**
     * @return mixed
     */
    public function getDexterity()
    {
        return $this->attributes[Attribute::Dexterity];
    }

    /**
     * @param $dexterity
     */
    public function setDexterity($dexterity){
        $this->attributes[Attribute::Strength] = $dexterity;
    }

    /**
     * @return mixed
     */
    public function getIntelligence()
    {
        return $this->attributes[Attribute::Intelligence];
    }

    /**
     * @param $intelligence
     */
    public function setIntelligence($intelligence){
        $this->attributes[Attribute::Strength] = $intelligence;
    }

    /**
     * @return mixed
     */
    public function getCurrentHitPoints()
    {
        return $this->currentHitPoints;
    }

    /**
     * @return mixed
     */
    public function isDead()
    {
        return $this->isDead;
    }

    /**
     * Revives this entity at full health.
     */
    public function revive(){
        $this->isDead = false;
        $this->currentHitPoints = $this->maxHitPoints();
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }
}