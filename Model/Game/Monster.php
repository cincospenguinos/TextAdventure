<?php
/**
 * Created by PhpStorm.
 * User: tsvetok
 * Date: 8/1/16
 * Time: 9:37 PM
 */

namespace LinkedWorldsCore;

require_once 'Entity.php';
require_once 'Attribute.php';

class Monster extends Entity
{
    // TODO: Switch to factory design pattern?
    // TODO: Testing
    private $isHostile, $name, $description, $aliases;

    public function __construct($_attributes, $_name, $_description, $_isHostile = true)
    {
        $this->name = $_name;
        $this->description = $_description;
        $this->isHostile = $_isHostile;
        $this->aliases = [];
        $this->attributes = $_attributes;
        $this->currentHitPoints = $this->maxHitPoints();
        $this->setLevelFromAttributes();
    }

    /**
     * Gives this monster damage, and drops all their equipped items upon death.
     *
     * @param $amount
     * @return bool
     */
    public function takeDamage($amount){
        parent::takeDamage($amount);

        if($this->isDead)
            $this->equippedItems = [];

        return $this->isDead;
    }

    public function physicalToHit()
    {
        return Attribute::getModifier($this->getDexterity()) / 2 + $this->getAllEquippedModifiers(Attribute::PhysicalToHit);
    }

    /**
     * Returns the amount of physical damage this entity does.
     *
     * @return integer
     */
    public function physicalDamage()
    {
        return ($this->rollWeaponDamage() + Attribute::getModifier($this->getStrength())) / 2 + $this->getAllEquippedModifiers(Attribute::PhysicalDamage);
    }

    /**
     * Checks to see if this entity hits a spell attack on the target provided.
     *
     * @return boolean
     */
    public function spellToHit()
    {
        return Attribute::getModifier($this->getConstitution()) / 2 + $this->getAllEquippedModifiers(Attribute::SpellToHit);
    }

    /**
     * Returns the amount of spell damage this entity does.
     *
     * @return integer
     */
    public function spellDamage()
    {
        // TODO: How will we do spell damage from weapons?
        return (mt_rand(1, 4) + Attribute::getModifier($this->getIntelligence())) / 2 + $this->getAllEquippedModifiers(Attribute::SpellDamage);
    }

    /**
     * Returns the evasiveness for this entity.
     *
     * @return double
     */
    public function evasiveness()
    {
        return (3 + $this->getDexterity() + Attribute::getModifier($this->getIntelligence())) / 2 + $this->getAllEquippedModifiers(Attribute::Evasiveness);
    }

    /**
     * Returns the maximum hitpoints for this entity.
     *
     * @return integer
     */
    public function maxHitPoints()
    {
        return (3 + $this->getConstitution() + Attribute::getModifier($this->getStrength())) / 2 + $this->getAllEquippedModifiers(Attribute::MaxHitPoints);
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

    /**
     * Sets the level from the attributes amount.
     *
     * TODO: Balance this
     */
    private function setLevelFromAttributes(){
        $this->level = 0;
        $counter = 1;
        $sum = array_sum($this->attributes);
        while($this->level + $counter * 3 < 9 - $sum){
            $this->level += 1;
            $counter += 1;
        }
    }
}