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
 * TODO: IDEA! What if the user creating the dungeon simply set their "final room" to have an exit to The Void?
 * TODO: Should the player simply have a "current dungeon" associated with them? Or just their current room, and a reference to a dungeon? Figure out the DB stuff man.
 *
 * @package LinkedWorldsCore
 */
class Dungeon
{

    private $rooms, $dungeonCreator, $dungeonName, $dungeonDescription, $startRoom;

    public function __construct($_dungeonName, $_dungeonDescription, $_dungeonCreator){
        $this->rooms = [];
        $this->dungeonName = $_dungeonName;
        $this->dungeonDescription = $_dungeonDescription;
        $this->dungeonCreator = $_dungeonCreator;
    }

    public function getStartRoom(){
        return $this->startRoom;
    }

    public function setStartRoom($room){
        $this->startRoom = $room;
    }

    /**
     * Adds the provided room to the dungeon.
     *
     * @param $room
     */
    public function addRoom($room){
        $this->rooms[$room->getGUID()] = [];
    }

    /**
     * Adds the whole collection of rooms provided to this dungeon.
     *
     * @param $rooms
     */
    public function addRooms($rooms){
        foreach($rooms as $room){
            $this->addRoom($room);
        }
    }

    /**
     * Returns true if the room passed exists in the collection of rooms.
     *
     * @param $room
     * @return bool
     */
    public function hasRoom($room){
        if (isset($this->rooms[$room->getGUID()]))
            return true;

        return false;
    }

    /**
     * Returns the room connected to $previous room at the direction provided, or false if there isn't a room that way.
     *
     * @param $currentRoom
     * @param $direction
     * @return bool
     */
    public function getNextRoom($currentRoom, $direction){
        if($direction < 0 || !isset($this->rooms[$currentRoom->getGUID()]) || !isset($this->rooms[$currentRoom->getGUID()][$direction]))
            return false;

        return $this->rooms[$currentRoom->getGUID()][$direction];
    }

    /**
     * Removes the room from the collection.
     *
     * @param $roomToDelete
     */
    public function removeRoom($roomToDelete){
        $roomToDeleteGUID = $roomToDelete->getGUID();
        unset($this->rooms[$roomToDeleteGUID]);

        foreach($this->rooms as $someGUID => $roomArray){
            foreach($roomArray as $direction => $room){
                if($room->getGUID() === $roomToDeleteGUID)
                    unset($this->rooms[$someGUID][$direction]);
            }
        }
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
            $this->rooms[$source->getGUID()][$direction] = $target;
        else
            return false;

        return true;
    }

    // TODO: Should hasExit() be used to check if one room is connected to another, or just that one room has an exit in a direction?

    /**
     * Returns true if the room has an exit in the direction passed.
     *
     * @param $from
     * @param $direction
     * @return bool
     */
    public function hasExit($from, $direction) {
        if($this->hasRoom($from) && isset($this->rooms[$from->getGUID()][$direction])){
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
        if(isset($this->rooms[$from->getGUID()]))
            unset($this->rooms[$from->getGUID()][$direction]);
    }

    /**
     * Returns true if this dungeon is "legal."
     *
     * TODO: This. Eventually.
     *
     * @return bool
     */
    public function isLegalDungeon(){
        return true;
    }

    public function getAllRooms(){
        // TODO: This is for debugging. Remove it when pushing to production
        return $this->rooms;
    }

    public function getAllExitDirections($room){
        if(!isset($this->rooms[$room->getGUID()]))
            return [];

        return array_keys($this->rooms[$room->getGUID()]);
    }
}