<?php
/**
 * Created by PhpStorm.
 * User: tsvetok
 * Date: 5/24/16
 * Time: 9:49 PM
 */

require_once '../Room.php';
require_once '../Player.php';

class PlayerTest extends \PHPUnit_Framework_TestCase
{
    public function testPlayerConstructor(){
        $room = new \LinkedWorldsCore\Room('Room', 'This is a room.');
        $player = new \LinkedWorldsCore\Player('Player', $room);
    }

}