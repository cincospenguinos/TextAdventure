<?php
/**
 * Represents a single player in the game. NOT to be confused with a user, dungeon creator, etc.
 *
 * User: Andre LaFleur
 * Date: 5/13/16
 * Time: 3:10 PM
 */

namespace LinkedWorldsCore;


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
        return false;
    }

    public function look(){

    }

    public function lookAt($itemName){

    }

    public function hasItem($itemName){

    }

    public function getItemFromRoom($itemName){

    }
}