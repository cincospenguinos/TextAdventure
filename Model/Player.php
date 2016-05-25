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

class Player // TODO: Implement all of this
{
    private $username, $currentRoom, $inventory;

    /**
     * Player constructor.
     * @param $_username
     * @param $_startingRoom
     */
    public function __construct($_username, $_startingRoom){
        // TODO: Type checking?

        $this->inventory = [];
        $this->username = $_username;
        $this->currentRoom = $_startingRoom;
    }

    /**
     * Causes the player to go in the direction provided. Returns true if the player moved to that room, or false
     * if that room does not exist.
     *
     * @param $direction
     * @return bool
     */
    public function goDirection($direction){
        $room = $this->currentRoom->goDirection($direction);

        if($room != null){
            $this->currentRoom = $room;
            return true;
        } else {
            return false;
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

    public function lookAt($itemName){
        // TODO
    }

    public function hasItem($itemName){
        // TODO
    }

    public function getItemFromRoom($itemName){
        // TODO
    }

    public function getCurrentRoomName(){
        return $this->currentRoom->getRoomName();
    }
}