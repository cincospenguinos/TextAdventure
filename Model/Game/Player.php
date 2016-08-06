<?php
/**
 * Represents a single player in the game. NOT to be confused with a user, dungeon creator, etc.
 *
 * User: Andre LaFleur
 * Date: 5/13/16
 * Time: 3:10 PM
 */

namespace LinkedWorldsCore;

require_once 'Room.php';
require_once 'Item.php';
require_once 'Entity.php';
require_once 'Attribute.php';
require_once 'Dungeon.php';
require_once 'Weapon.php';

class Player extends Entity
{
    // TODO: More tests --> look up coverage testing with PhpStorm & PHPUnit
    // TODO: Equippable items - how do?
    private $username, $currentRoom, $inventory, $currentDungeon, $handSlots, $equippedItems;

    /**
     * Player constructor.
     * @param $_username
     * @param $_startingRoom
     */
    public function __construct($_username, $_dungeon) {
        $this->inventory = [];
        $this->username = $_username;
        $this->currentDungeon = $_dungeon;
        $this->currentRoom = $_dungeon->getStartRoom();

        // Base stats - by default they start at 5
        $this->level = 1;
        $this->attributes = [5, 5, 5, 5];
        $this->currentHitPoints = $this->maxHitPoints();

        // Everything to do with items
        // TODO: Put this stuff into Entity
        $this->handSlots = 2;
        $this->equippedItems = [];
    }

    /**
     * Causes the player to go in the direction provided. Returns true if the player moved to that room, or false
     * if that room does not exist.
     *
     * @param $direction
     * @return bool
     */
    public function goDirection($direction){
        $room = $this->currentDungeon->getNextRoom($this->currentRoom, $direction);

        if(!$room){
            return false;
        } else {
            $this->currentRoom = $room;
            return true;
        }
    }

    /**
     * Returns the description of the current room.
     *
     * @return string
     */
    public function look(){
        return $this->currentRoom->look();
    }

    /**
     * Returns the description of the item matching the name provided, either in the player's
     * inventory or in the room itself.
     *
     * TODO: What about the case where there are two items of the same name?
     *
     * @param $itemName
     * @return string or null
     */
    public function lookAt($itemName) {
        if(isset($this->inventory[strtolower($itemName)]))
            return $this->inventory[strtolower($itemName)]->getLookAtDescription();

        // Don't forget to check for item aliases!
        foreach($this->inventory as $item)
            if($item->hasAlias($itemName))
                return $item->getLookAtDescription();

        $description = $this->currentRoom->lookAt($itemName);

        return $description;
    }

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
     * Takes the item matching the item name passed from the current room.
     *
     * @param $itemName
     * @return bool
     */
    public function takeItem($itemName){
        $item = $this->currentRoom->removeItem($itemName);

        if(is_null($item))
            return "The item \"{$itemName}\" could not be found.";
        else if(!$item)
            return 'That item cannot be taken.';

        $this->inventory[strtolower($item->getName())] = $item;
        return true;
    }

    /**
     * Drops the item matching the name passed into the current room. Returns true if successful and returns
     * false if the item does not exist in the player's inventory.
     *
     * @param $itemName
     * @return bool
     */
    public function dropItem($itemName){
        $itemName = strtolower($itemName);

        if(isset($this->inventory[$itemName])){
            $this->currentRoom->addItem($this->inventory[$itemName]);
            unset($this->inventory[$itemName]);
            return true;
        }

        // Check by alias
        foreach($this->inventory as $item){
            if($item->hasAlias($itemName)){
                $itemName = strtolower($item->getName());
                $this->currentRoom->addItem($this->inventory[$itemName]);
                unset($this->inventory[$itemName]);
                return true;
            }
        }

        return false;
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
     * @return bool
     */
    public function equip($itemName) {
        $toEquip = null;

        if(is_null($toEquip))
            return 'That item could not be found on your person.';

        if($toEquip instanceof Weapon){
            if($this->handSlots - $toEquip->getHandSlots() >= 0){
                $this->handSlots -= $toEquip->getHandSlots();
            } else {
                return 'You do not have enough hands to equip that item.';
            }
        }

        $this->equippedItems[strtolower($toEquip->getName())];

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

        unset($this->equippedItems[strtolower($toUnequip->getName())]);
        return true;
    }

    /**
     * Returns an array of the names of all the items in the player's inventory.
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
     * Returns the current room this player is in.
     *
     * @return mixed
     */
    public function getCurrentRoom(){
        return $this->currentRoom;
    }

    public function getAllExitDirections(){
        return $this->currentDungeon->getAllExitDirections($this->currentRoom);
    }

    public function getCurrentDungeon() {
        return $this->currentDungeon;
    }

    /**
     * Returns just the name of the current room.
     *
     * @return mixed
     */
    public function getCurrentRoomName()
    {
        return $this->currentRoom->getRoomName();
    }

    /**
     * Returns physical to hit modifier.
     *
     * @return int
     */
    public function physicalToHit()
    {
        return Attribute::getModifier($this->getDexterity()) + $this->getAllEquippedModifiers(Attribute::PhysicalToHit);
    }

    /**
     * Returns the amount of physical damage this entity does.
     *
     * @return integer
     */
    public function physicalDamage()
    {
        return $this->rollWeaponDamage() + Attribute::getModifier($this->getStrength()) + $this->getAllEquippedModifiers(Attribute::PhysicalDamage);
    }

    /**
     * Checks to see if this entity hits a spell attack on the target provided.
     *
     * @param $target
     * @return boolean
     */
    public function spellToHit()
    {
        return Attribute::getModifier($this->getConstitution()) + $this->getAllEquippedModifiers(Attribute::SpellToHit);
    }

    /**
     * Returns the amount of spell damage this entity does.
     *
     * @return integer
     */
    public function spellDamage()
    {
        // TODO: Include the spell damage amount here - should change depending on the spell
        return mt_rand(1, 4) + Attribute::getModifier($this->getIntelligence()) + $this->getAllEquippedModifiers(Attribute::SpellDamage);
    }

    /**
     * Returns the evasiveness for this entity.
     *
     * @return double
     */
    public function evasiveness()
    {
        return 3 + $this->getDexterity() + Attribute::getModifier($this->getIntelligence());
    }

    public function getCurrentHitPoints()
    {
        return $this->currentHitPoints;
    }

    /**
     * Returns the maximum hitpoints for this entity.
     *
     * @return integer
     */
    public function maxHitPoints()
    {
        return 3 + $this->getConstitution() + Attribute::getModifier($this->getStrength());
    }

    /**
     * Returns a weapon damage roll for the player. Returns the unarmed damage amount if the player doesn't have a
     * weapon.
     *
     * @return int
     */
    private function rollWeaponDamage(){
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
    private function getAllEquippedModifiers($attribute){
        $sum = 0;

        foreach($this->equippedItems as $itemName){
            $item = $this->inventory[$itemName];

            if($item->hasEquipModifier($attribute))
                $sum += $item->getEquipModifier($attribute);
        }

        return $sum;
    }
}