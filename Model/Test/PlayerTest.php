<?php
/**
 * Created by PhpStorm.
 * User: tsvetok
 * Date: 5/24/16
 * Time: 9:49 PM
 */

require_once '../Room.php';
require_once '../Player.php';
require_once '../Direction.php';

class PlayerTest extends \PHPUnit_Framework_TestCase
{
    private $playerOne, $dungeonOne;

    public function setUp(){
        $this->dungeonOne = new LinkedWorldsCore\Room("Room 1", "This is the first room.");
        $room = new LinkedWorldsCore\Room("Room 2", "This is the second room.");

        $room->addExit(LinkedWorldsCore\Direction::West, $this->dungeonOne);
        $this->dungeonOne->addExit(\LinkedWorldsCore\Direction::East, $room);

        $this->playerOne = new LinkedWorldsCore\Player("Player 1", $this->dungeonOne);
    }

    public function tearDown(){
        unset($this->dungeonOne);
        unset($this->playerOne);
    }

    /**
     * Just calls the constructor.
     */
    public function testPlayerConstructor(){
        $room = new \LinkedWorldsCore\Room('Room', 'This is a room.');
        $player = new \LinkedWorldsCore\Player('Player', $room);
    }

    /**
     * When I tell the player to move to a new room, the player moves to the new room.
     */
    public function testMoveToNewRoom(){
        $this->assertTrue($this->playerOne->goDirection(\LinkedWorldsCore\Direction::East));
        $this->assertTrue(strcmp($this->playerOne->getCurrentRoomName(), "Room 2") == 0);
    }
}