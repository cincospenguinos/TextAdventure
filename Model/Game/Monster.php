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
    // TODO: Testing
    private $isHostile, $name, $description, $aliases;

    public function __construct($_level, $_name, $_description, $_isHostile = true)
    {
        $this->level = $_level;
        $this->name = $_name;
        $this->description = $_description;
        $this->isHostile = $_isHostile;

        $this->aliases = [];
    }

    public function physicalToHit()
    {
        return 0.1 * (3.0 * $this->dexterity / 7.0) + $this->level * 0.02 + 0.3;
    }

    /**
     * Returns the amount of physical damage this entity does.
     *
     * @return integer
     */
    public function physicalDamage()
    {
        return 1 + mt_rand(1, $this->strength / 2) + $this->level;
    }

    /**
     * Checks to see if this entity hits a spell attack on the target provided.
     *
     * @return boolean
     */
    public function spellToHit()
    {
        return 0.1 * (3.0 * $this->constitution / 7.0) + $this->level * 0.02 + 0.3;
    }

    /**
     * Returns the amount of spell damage this entity does.
     *
     * @return integer
     */
    public function spellDamage()
    {
        return 1 + mt_rand(1, $this->intelligence / 2) + $this->level;
    }

    /**
     * Returns the evasiveness for this entity.
     *
     * @return double
     */
    public function evasiveness()
    {
        return (2 * $this->dexterity / 3.0 + $this->intelligence / 3.0) * 0.02 + ($this->level - 1) * 0.02;
    }

    /**
     * Returns the maximum hitpoints for this entity.
     *
     * @return integer
     */
    public function maxHitPoints()
    {
        return (3 * $this->constitution) / 4 + $this->strength / 4 + 2 * ($this->level - 1);
    }

    /**
     * Returns true if the alias passed exists in the collection of aliases for this item.
     *
     * @param $alias
     * @return bool
     */
    public function hasAlias($alias){
        return isset($this->aliases[strtolower($alias)]);
    }

    /**
     * Adds the alias passed
     *
     * @param $alias
     */
    public function addAlias($alias){
        $this->aliases[strtolower($alias)] = 1;
    }

    /**
     * Removes the alias matching the name provided, given that it exists.
     *
     * @param $alias
     */
    public function removeAlias($alias){
        unset($this->aliases[strtolower($alias)]);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return boolean
     */
    public function isHostile()
    {
        return $this->isHostile;
    }

    /**
     * @param boolean $isHostile
     */
    public function setHostile($isHostile)
    {
        $this->isHostile = $isHostile;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}