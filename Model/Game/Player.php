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
    // TODO: Look up coverage testing with PhpStorm & PHPUnit
    private $username, $currentRoom, $currentDungeon;

    /**
     * Player constructor.
     * @param $_username
     * @param $_dungeon
     * @internal param $_startingRoom
     */
    public function __construct($_username, $_dungeon) {
        $this->username = $_username;
        $this->currentDungeon = $_dungeon;
        $this->currentRoom = $_dungeon->getStartRoom();

        // Base stats - by default they start at 5
        $this->level = 1;
        $this->attributes = [5, 5, 5, 5];
        $this->currentHitPoints = $this->maxHitPoints();
        $this->handSlots = 2;
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
        return 3 + $this->getConstitution() + Attribute::getModifier($this->getStrength()) + $this->getAllEquippedModifiers(Attribute::MaxHitPoints);
    }
}