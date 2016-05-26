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

class Player
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

    /**
     * Returns the description of the item matching the name provided, either in the player's
     * inventory or in the room itself.
     *
     * TODO: What about the case where there are two items of the same name?
     *
     * @param $itemName
     * @return string or null
     */
    public function lookAt($itemName){
        foreach($this->inventory as $item){
            if(strcasecmp($itemName, $item->getItemName()) === 0)
                return $item->getDescription();
        }

        $item = $this->currentRoom->lookAt($itemName);

        return $item;
    }

    /**
     * Returns true if the player has the item matching the name provided.
     *
     * @param $itemName
     * @return bool
     */
    public function hasItem($itemName){
        foreach($this->inventory as $item){
            if(strcasecmp($itemName, $item->getItemName()) === 0)
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
            return false;

        array_push($this->inventory, $item);

        return true;
    }

    public function getCurrentRoomName(){
        return $this->currentRoom->getRoomName();
    }
}