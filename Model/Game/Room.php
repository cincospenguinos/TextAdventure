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

class Room
{
    /*
     * $exits is an array mapping directions to rooms (like a graph)
     * $itemsInRoom will always, ALWAYS use the lower case item names as keys mapping to item objects.
     * If we don't do it that way, then we're all ducked. Or more challengin code needs to be written.
     */
    private $roomName, $exits, $description, $itemsInRoom;

    public function __construct($_roomName, $_description)
    {
        $this->roomName = $_roomName;
        $this->exits = [];
        $this->description = $_description;
        $this->itemsInRoom = [];
    }

    /**
     * Returns the description of the room as well as descriptions of the exits.
     *
     * @return string
     * @throws \TypeError
     */
    public function look(){

        $description = $this->description;

        if(!empty($exits)){
            $description .= "\n\nExits are to the ";

            foreach($this->exits as $exit){
                $description .= Direction::toString($exit) . ', ';
            }

            $description .= '.';
        }



        return $description;
    }

    /**
     * Returns the description of the item matching the item name provided.
     *
     * @param $itemName
     * @return string or null
     */
    public function lookAt($itemName){
        $itemName = strtolower($itemName);

        if(isset($this->itemsInRoom[$itemName]))
            return $this->itemsInRoom[$itemName]->getDescription();

        return null;
    }

    /**
     * Returns the room in the direction provided.
     *
     * @param $direction
     * @return Room object, or null
     */
    public function goDirection($direction){
        return $this->exits[$direction];
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