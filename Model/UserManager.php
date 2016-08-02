<?php

/**
 * Class that contains all of the various methods that manage users. Handles all of the memcaching and database lookup
 * information necessary for Users.
 *
 * TODO: Create a series of test cases for this class. This one needs to be tested to death.
 *
 * User: tsvetok
 * Date: 5/27/16
 * Time: 12:55 PM
 */
include_once 'Game/Player.php';
include_once 'Game/Room.php';

class UserManager
{
    /**
     * Generates a brand new player with the username provided. Returns a Player object with the tutorial
     * dungeon setup.
     *
     * @param $username
     * @return \LinkedWorldsCore\Player
     */
    public static function generateNewPlayer($username){
        $dungeon = null;
        include 'Game/tutorial_dungon.php';
        $player = new \LinkedWorldsCore\Player($username, $dungeon);

        return $player;
    }

    public static function login($username, $password){
        // TODO: this
    }

    public static function logout($username){
        // TODO: this
    }
}