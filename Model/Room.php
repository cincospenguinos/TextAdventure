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

    public function addExit($direction, $room){

    }

    public function removeExit($direction){

    }

    /**
     * Returns the description of this room.
     *
     * @return string
     */
    public function getDescription(){
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
}