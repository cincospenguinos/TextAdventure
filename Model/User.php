<?php

/**
 * Class representing a user on the web app itself - NOT to be confused with "Player".
 *
 * TODO: This
 *
 * User: tsvetok
 * Date: 5/26/16
 * Time: 9:12 PM
 */
class User
{
    private $username, $player;

    public function __construct($_username, $_player)
    {
    }

    public function getPlayer(){
        return $this->player;
    }
}