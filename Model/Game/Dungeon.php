<?php
/**
 * Created by PhpStorm.
 * User: tsvetok
 * Date: 8/2/16
 * Time: 4:33 PM
 */

namespace LinkedWorldsCore;

/**
 * Class Dungeon
 *
 * Holds a collection of rooms as well as all of the meta data associated with a given dungeon.
 *
 * TODO: Use this class instead of just one room and a janky DAG. Implement a linked-list style DAG here.
 * TODO: IDEA! What if the user creating the dungeon simply set their "final room" to have an exit to The Void?
 * TODO: Should the player simply have a "current dungeon" associated with them? Or just their current room, and a reference to a dungeon? Figure out the DB stuff man.
 *
 * @package LinkedWorldsCore
 */
class Dungeon
{

    private $rooms, $dungeonName, $dungeonDescription, $startRoom;

    public function __construct($_dungeonName, $_dungeonDescription){
        $this->rooms = [];
        $this->dungeonName = $_dungeonName;
        $this->dungeonDescription = $_dungeonDescription;
    }

    /**
     * Adds the provided room to the dungeon.
     *
     * @param $room
     */
    public function addRoom($room){
        $this->rooms[$room] = [];
    }

    /**
     * Returns true if the room passed exists in the collection of rooms.
     *
     * @param $room
     * @return bool
     */
    public function hasRoom($room){
        if (isset($this->rooms[$room]))
            return true;

        return false;
    }

    /**
     * Returns the room connected to $previous room at the direction provided, or false if there isn't a room that way.
     *
     * @param $previousRoom
     * @param $direction
     * @return bool
     */
    public function getNextRoom($previousRoom, $direction){
        if($direction < 0 || !isset($this->rooms[$previousRoom]) || !isset($this->rooms[$previousRoom][$direction]))
            return false;

        return $this->rooms[$previousRoom][$direction];
    }

    /**
     * Removes the room from the collection.
     *
     * @param $room
     */
    public function removeRoom($room){
        unset($this->rooms[$room]);
    }

    /**
     * Add an exit from the source room to the target room, through the direction passed. Returns true if
     * the addition was successful.
     *
     * @param $source
     * @param $target
     * @param $direction
     * @return bool
     */
    public function addExit($source, $target, $direction){
        if($direction >= 0 && $this->hasRoom(($source)) && $this->hasRoom($target))
            $this->rooms[$source][$direction] = $target;
        else
            return false;

        return true;
    }

    /**
     * Returns true if the room has an exit in the direction passed.
     *
     * @param $from
     * @param $direction
     * @return bool
     */
    public function hasExit($from, $direction) {
        if($this->hasRoom($from) && isset($this->rooms[$from][$direction])){
            return true;
        }

        return false;
    }

    /**
     * Removes the exit from the room passed at the direction provided..
     *
     * @param $from
     * @param $direction
     */
    public function removeExit($from,  $direction) {
        if(isset($this->rooms[$from]))
            unset($this->rooms[$from][$direction]);
    }

    /**
     * Returns true if this dungeon is "legal."
     *
     * TODO: I don't know if this is necessary - should check and see if there is an exit to the void and if it's possible to get there.
     *
     * @return bool
     */
    public function isLegalDungeon(){
        return true;
    }
}