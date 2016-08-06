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

class Player extends Entity
{
    // TODO: More tests --> look up coverage testing with PhpStorm & PHPUnit
    // TODO: Equippable items - how do?
    private $username, $currentRoom, $inventory, $currentDungeon;

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
     * Takes the item matching the item name passed from the room provided.
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

        $this->inventory[strtolower($item->getItemName())] = $item;
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
                $itemName = strtolower($item->getItemName());
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
        $this->inventory[strtolower($item->getItemName())] = $item;
    }

    /**
     * Equips the item provided given that the player has the item matching the name provided and
     * that the item is equippable. Returns true if equipped.
     *
     * @param $itemName
     * @return bool
     */
    public function equip($itemName){
        // TODO: This

        return false;
    }

    /**
     * Returns an array of the names of all the items in the player's inventory.
     *
     * @return array
     */
    public function getItemList(){
        $items = [];

        foreach($this->inventory as $item)
            array_push($items, $item->getItemName());

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
     * @return int
     */
    public function physicalToHit()
    {
        return Attribute::getModifier($this->getDexterity());
    }

    /**
     * Returns the amount of physical damage this entity does.
     *
     * @return integer
     */
    public function physicalDamage()
    {
        // TODO: Include weapon damage here
        return mt_rand(1, 4) + Attribute::getModifier($this->getStrength());
    }

    /**
     * Checks to see if this entity hits a spell attack on the target provided.
     *
     * @param $target
     * @return boolean
     */
    public function spellToHit()
    {
        return Attribute::getModifier($this->getConstitution());
    }

    /**
     * Returns the amount of spell damage this entity does.
     *
     * @return integer
     */
    public function spellDamage()
    {
        // TODO: Include weapon damage here
        return mt_rand(1, 4) + Attribute::getModifier($this->getIntelligence());
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
}