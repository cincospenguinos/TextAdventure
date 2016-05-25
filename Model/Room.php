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
        // TODO: How to do the exit descriptions.
        $description = '';
        $description = $this->description . $description . "\n\nExits are to the ";

        foreach($this->exits as $exit){
            $description = $description . Direction::toString($exit);
        }

        return $description;
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
     * Adds the item passed into the array
     *
     * @param $item
     */
    public function addItem($item){
        // TODO: Type checking?

        array_push($this->itemsInRoom, $item);
    }

    /**
     * Removes the item from the collection of items in this room. Returns that item if it exists
     * or null if it does not exist.
     *
     * @param $itemName
     * @return Item|null
     */
    public function removeItem($itemName){
        $itemToBeRemoved = null;

        foreach($this->itemsInRoom as $itemArrayKey => $item){
            if(strcmp($item->getItemName(), $itemName)) {
                $itemToBeRemoved = Item::copy($item);
                unset($this->itemsInRoom[$itemArrayKey]);
                break;
            }
        }

        return $itemToBeRemoved;
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
        // TODO: type checking

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