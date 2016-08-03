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
    // TODO: Inventory at top level?
    // TODO: Proper attributes. Use an enum. This will make equipment much easier.
    protected $strength, $constitution, $dexterity, $intelligence, $currentHitPoints, $isDead, $level;

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
     * Make an attack on a given target. Optional paramaters available if a spell is being used.
     *
     * @param $target
     * @param bool $isSpell
     * @param null $spell
     * @return boolean
     */
    public function attack($target, $isSpell = false, $spell = null) {
        $roll = mt_rand() / mt_getrandmax();

        if ($isSpell){
            $roll += $this->spellToHit();
        } else {
            $roll += $this->physicalToHit();
        }

        if ($roll > $target->evasiveness())
            return true;

        return false;
    }

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
        return $this->strength;
    }

    /**
     * @param mixed $strength
     */
    public function setStrength($strength)
    {
        $this->strength = $strength;
    }

    /**
     * @return mixed
     */
    public function getConstitution()
    {
        return $this->constitution;
    }

    /**
     * @param mixed $constitution
     */
    public function setConstitution($constitution)
    {
        $this->constitution = $constitution;
    }

    /**
     * @return mixed
     */
    public function getDexterity()
    {
        return $this->dexterity;
    }

    /**
     * @param mixed $dexterity
     */
    public function setDexterity($dexterity)
    {
        $this->dexterity = $dexterity;
    }

    /**
     * @return mixed
     */
    public function getIntelligence()
    {
        return $this->intelligence;
    }

    /**
     * @param mixed $intelligence
     */
    public function setIntelligence($intelligence)
    {
        $this->intelligence = $intelligence;
    }

    /**
     * @return mixed
     */
    public function getCurrentHitPoints()
    {
        return $this->currentHitPoints;
    }

    /**
     * @param mixed $currentHitPoints
     */
    public function setCurrentHitPoints($currentHitPoints)
    {
        $this->currentHitPoints = $currentHitPoints;
    }

    /**
     * @return mixed
     */
    public function isDead()
    {
        return $this->isDead;
    }

    /**
     * @param mixed $isDead
     */
    public function setIsDead($isDead)
    {
        $this->isDead = $isDead;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }
}