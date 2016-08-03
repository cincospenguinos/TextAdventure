<?php
/**
 * A single room that is intended to be a part of a dungeon.
 *
 * User: Andre LaFleur
 * Date: 5/13/16
 * Time: 3:10 PM
 */

namespace LinkedWorldsCore;

require_once 'Direction.php';
require_once 'Item.php';
require_once 'Monster.php';

class Room
{
    /*
     * $exits is an array mapping directions to rooms (like a graph)
     * $itemsInRoom will always, ALWAYS use the lower case item names as keys mapping to item objects.
     * If we don't do it that way, then we're all ducked. Or more challengin code needs to be written.
     */
    private $roomName, $exits, $description, $itemsInRoom, $monstersInRoom;

    public function __construct($_roomName, $_description)
    {
        $this->roomName = $_roomName;
        $this->exits = [];
        $this->description = $_description;
        $this->itemsInRoom = [];
        $this->monstersInRoom = [];
    }

    /**
     * Returns the description of the room as well as descriptions of the exits.
     *
     * @return string
     * @throws \TypeError
     */
    public function look(){
        $description = $this->description;

        foreach($this->itemsInRoom as $item) {
            $description .= " You see a " . strtolower($item->getItemName()) . " here.";
        }

        foreach($this->monstersInRoom as $monster){
            $description .= " There is a " . $monster->getName() . " here.";
        }

        return $description;
    }

    /**
     * Returns the description of the item or the monster matching the name provided.
     *
     * @param $name
     * @return string or null
     */
    public function lookAt($name){
        $name = strtolower($name);

        if(isset($this->itemsInRoom[$name]))
            return $this->itemsInRoom[$name]->getDescription();

        // Don't forget to check for item aliases!
        foreach($this->itemsInRoom as $item)
            if($item->hasAlias($name))
                return $item->getDescription();

        if(isset($this->monstersInRoom[$name]))
            return $this->monstersInRoom[$name]->getDescription();

        // Don't forget to check for item aliases!
        foreach($this->monstersInRoom as $monster)
            if($monster->hasAlias($name))
                return $monster->getDescription();

        return null;
    }

    /**
     * Returns the room in the direction provided.
     *
     * @param $direction
     * @return Room object, or null
     */
    public function goDirection($direction){
        if(isset($this->exits[$direction]))
            return $this->exits[$direction];

        return null;
    }

    /**
     * Returns an array of all the directions that this room has an exit through.
     *
     * @return array
     */
    public function getAllExitDirections(){
        return array_keys($this->exits);
    }

    /**
     * Adds an exit in this room to the next room.
     *
     * @param $direction
     * @param $room
     * @throws \TypeError if $direction is not a number
     */
    public function addExit($direction, $room){
         if(!is_numeric($direction))
             throw new \TypeError("\$direction must be a numeric identifier!");

        $this->exits[$direction] = $room;
    }

    public function hasExit($direction){
        if(!is_numeric($direction))
            throw new \TypeError("\$direction must be a numeric identifier!");

        return isset($this->exits[$direction]);
    }

    /**
     * Removes the exit in the given direction, whether it exists or not. Throws TypeError
     * if the direction passed is not a numeric identifier.
     *
     * @param $direction
     * @throws \TypeError
     */
    public function removeExit($direction){
        if(!is_numeric($direction))
            throw new \TypeError("\$direction must be a numeric identifier!");

        unset($this->exits[$direction]);
    }

    /**
     * Adds the item passed into the array.
     *
     * TODO: Should an error be thrown if an item with that name already exists? How should we manage copies?
     * TODO: Should we throw an error here if $item is not an Item?
     * @param $item
     */
    public function addItem($item) {
        $this->itemsInRoom[strtolower($item->getItemName())] = $item;
    }

    /**
     * Returns true if the item matching the name provided is inside of this room.
     *
     * @param $itemName
     * @return bool
     */
    public function hasItem($itemName) {
        $itemName = strtolower($itemName);
        if(isset($this->itemsInRoom[strtolower($itemName)]))
            return true;

        foreach($this->itemsInRoom as $item){
            if($item->hasAlias($itemName))
                return true;
        }

        return false;
    }

    /**
     * Removes the item from the collection of items in this room. Returns that item if it exists
     * or null if it does not exist. Seeks first to match the name of the item and if that fails
     * checks all the aliases of all the items.
     *
     * @param $itemName
     * @return Item|null
     */
    public function removeItem($itemName) {
        $itemName = strtolower($itemName);

        if(isset($this->itemsInRoom[$itemName])) {
            $itemToBeRemoved = $this->itemsInRoom[$itemName]->copy();
            unset($this->itemsInRoom[$itemName]);
            return $itemToBeRemoved;
        } else {
            foreach($this->itemsInRoom as $item){
                if($item->hasAlias($itemName))
                    return $item;
            }
        }

        return null;
    }

    /**
     * Adds the monster passed to the collection.
     *
     * @param $monster
     */
    public function addMonster($monster){
        $this->monstersInRoom[strtolower($monster->getName())] = $monster;
    }

    /**
     * Returns true if the monster with the name passed exists in this room, or if it matches an alias.
     *
     * @param $monsterName
     * @return bool
     */
    public function hasMonster($monsterName){
        $monsterName = strtolower($monsterName);
        if(isset($this->monstersInRoom[strtolower($monsterName)]))
            return true;

        foreach($this->monstersInRoom as $item){
            if($item->hasAlias($monsterName))
                return true;
        }

        return false;
    }

    /**
     * Removes the monster matching the name passed.
     *
     * @param $monsterName
     */
    public function removeMonster($monsterName){
        unset($this->monstersInRoom[strtolower($monsterName)]);
    }

    /**
     * Returns the description of this room.
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Sets the description to this room
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        // TODO: type checking?

        $this->description = $description;
    }

    /**
     * Returns the name of this room.
     *
     * @return string
     */
    public function getRoomName()
    {
        return $this->roomName;
    }

    /**
     * Set the room name of this room to the name provided.
     *
     * @param string $roomName
     */
    public function setRoomName($roomName)
    {
        $this->roomName = $roomName;
    }
}