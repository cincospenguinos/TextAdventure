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
    // TODO: Inventory class to manage weight?
    protected $attributes = [0, 0, 0, 0];
    protected $inventory = [];
    protected $equippedItems = [];
    protected $handSlots = 2; // TODO: Make sure this is in Monster as well!
    protected $currentHitPoints, $isDead, $level;

    /**
     * Returns true if the player has the item matching the name provided.
     *
     * @param $itemName
     * @return bool
     */
    public function hasItem($itemName){
        $itemName = strtolower($itemName);
        if(isset($this->inventory[$itemName]))
            return true;

        foreach($this->inventory as $item){
            if($item->hasAlias($itemName))
                return true;
        }

        return false;
    }

    /**
     * Returns the item matching the item name, or null if the player is not carrying it.
     *
     * @param $itemName
     * @return mixed|null
     */
    public function getItem($itemName){
        $itemName = strtolower($itemName);
        if(isset($this->inventory[$itemName]))
            return $this->inventory[$itemName];
        else {
            foreach($this->inventory as $item){
                if($item->hasAlias($itemName))
                    return $item;
            }
        }

        return null;
    }

    /**
     * Removes the item passed from the Entity's inventory and returns it, or returns null if it does
     * not exit.
     *
     * @param $itemName
     * @return mixed|null
     */
    public function removeItem($itemName){
        $item = $this->getItem($itemName);

        if (isset($item)){
            unset($this->inventory[strtolower($item->getName())]);
            return $item;
        }

        return null;
    }

    /**
     * Gives the item passed directly to the player, independent of anything around happening in the game.
     *
     * @param $item
     */
    public function giveItem($item){
        $this->inventory[strtolower($item->getName())] = $item;
    }

    /**
     * Equips the item provided given that the player has the item matching the name provided and
     * that the item is equippable. Returns true if equipped, or a string describing the issue if
     * it could not be equipped.
     *
     * @param $itemName
     * @return bool|string
     */
    public function equip($itemName) {
        $toEquip = $this->getItem($itemName);

        if(is_null($toEquip))
            return 'You do not seem to be carrying that item.';

        if($toEquip->canEquip() === false)
            return 'You cannot equip that item.';

        if($toEquip instanceof Weapon){
            if($this->handSlots - $toEquip->getHandSlots() >= 0){
                $this->handSlots -= $toEquip->getHandSlots();
            } else {
                return 'You do not have enough hands to equip that item.';
            }
        }

        array_push($this->equippedItems, strtolower($toEquip->getName()));

        return true;
    }

    /**
     * Unequips the weapon matching the name provided. Returns true if it was unequipped, false if the item is not
     * being carried.
     *
     * @param $itemName
     * @return bool|string
     */
    public function unequip($itemName){
        $toUnequip = $this->getItem($itemName);

        if(is_null($toUnequip))
            return false;

        if($toUnequip instanceof Weapon)
            $this->handSlots += $toUnequip->getHandSlots();

        $this->equippedItems = array_diff($this->equippedItems, [strtolower($toUnequip->getName())]);
        return true;
    }

    /**
     * Returns an array of the names of all the items in the entity's inventory.
     *
     * @return array
     */
    public function getItemList(){
        $items = [];

        foreach($this->inventory as $item)
            array_push($items, $item->getName());

        return $items;
    }

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
     * @return boolean
     */
    public function takeDamage($amount){
        $this->currentHitPoints -= $amount;
        $this->isDead = $this->currentHitPoints < 0;

        return $this->isDead;
    }

    /**
     * Returns the strength stat for this entity.
     *
     * @return integer
     */
    public function getStrength()
    {
        return $this->attributes[Attribute::Strength] + $this->getAllEquippedModifiers(Attribute::Strength);
    }

    /**
     * Returns constitution stat for this entity.
     *
     * @return mixed
     */
    public function getConstitution()
    {
        return $this->attributes[Attribute::Constitution] + $this->getAllEquippedModifiers(Attribute::Constitution);
    }

    /**
     * Returns the dexterity stat for this entity.
     *
     * @return mixed
     */
    public function getDexterity()
    {
        return $this->attributes[Attribute::Dexterity] + $this->getAllEquippedModifiers(Attribute::Dexterity);
    }

    /**
     * Returns the intelligence stat for this entity.
     *
     * @return mixed
     */
    public function getIntelligence()
    {
        return $this->attributes[Attribute::Intelligence] + $this->getAllEquippedModifiers(Attribute::Intelligence);
    }

    /**
     * @param $strength
     */
    public function setStrength($strength){
        $this->attributes[Attribute::Strength] = $strength;
    }

    /**
     * @param $constitution
     */
    public function setConstitution($constitution){
        $this->attributes[Attribute::Strength] = $constitution;
    }

    /**
     * @param $dexterity
     */
    public function setDexterity($dexterity){
        $this->attributes[Attribute::Strength] = $dexterity;
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
     * Returns this entity's level.
     *
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    public function getEquippedItemNames(){
        return $this->equippedItems;
    }

    /**
     * Returns this Entity's max physical damage.
     *
     * @return int
     */
    public function maxPhysicalDamage(){
        $sum = 0;

        foreach($this->equippedItems as $itemName){
            $item = $this->inventory[$itemName];

            if($item instanceof Weapon){
                $sum += $item->getMaxDamage();
            }
        }

        return $sum;
    }

    /**
     * Returns this Entity's max spell damage.
     * @return int
     */
    public function maxSpellDamage(){
        // TODO: This
        return 0;
    }

    /**
     * Returns a weapon damage roll for the player. Returns the unarmed damage amount if the player doesn't have a
     * weapon.
     *
     * @return int
     */
    protected function rollWeaponDamage(){
        $sum = 0;

        foreach($this->equippedItems as $itemName){
            $item = $this->inventory[$itemName];

            if($item instanceof Weapon){
                $sum += $item->rollDamage();
            }
        }

        // If the player doesn't have a weapon, roll the disarmed damage amount, which is 1d4
        if($sum === 0)
            return mt_rand(1, 4);

        return $sum;
    }

    /**
     * Returns the sum ability modifier gained by all items equipped, given the ability to
     * search for.
     *
     * Example: Player has a sword equipped with +1 damamage, and a shield with +1 damage and +1
     * evasiveness. When this function is called requesting modifier for physical damage, this
     * method will return two.
     *
     * @param $attribute
     * @return integer
     */
    protected function getAllEquippedModifiers($attribute){
        $sum = 0;

        foreach($this->equippedItems as $itemName){
            $item = $this->inventory[$itemName];

            if($item->hasEquipModifier($attribute))
                $sum += $item->getEquipModifier($attribute);
        }

        return $sum;
    }
}