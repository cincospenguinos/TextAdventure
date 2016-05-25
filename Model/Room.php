<?php
/**
 * A single room that is intended to be a part of a dungeon.
 *
 * User: Andre LaFleur
 * Date: 5/13/16
 * Time: 3:10 PM
 */

namespace LinkedWorldsCore;


class Room
{
    private $roomName, $exits, $description, $itemsInRoom;

    public function __construct($_roomName, $_description)
    {
        $this->roomName = $_roomName;
        $this->exits = []; // Maps directions to other rooms
        $this->description = $_description;
        $this->itemsInRoom = [];
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

    public function look(){
        // TODO: How to do the exit descriptions.
        $description = '';
        $description = $this->description . $description . "\n\nExits are to the ";

        foreach($this->exits as $exit){
            $description . Direction::toString($exit);
        }

        return $description;
    }

    /**
     * @return mixed
     */
    public function getRoomName()
    {
        return $this->roomName;
    }

    /**
     * @param mixed $roomName
     */
    public function setRoomName($roomName)
    {
        $this->roomName = $roomName;
    }
}