<?php

/**
 * Created by PhpStorm.
 * User: tsvetok
 * Date: 8/2/16
 * Time: 5:50 PM
 */
require '../Dungeon.php';
require '../Room.php';
require_once '../Direction.php';

class DungeonTest extends PHPUnit_Framework_TestCase
{

    /**
     * Test the constructor
     */
    public function testConstructor(){
        $dungeon = new \LinkedWorldsCore\Dungeon('Some dungeon', 'A simple dungeon');
    }

    public function testAddRoom(){
        $dungeon = new \LinkedWorldsCore\Dungeon('Some dungeon', 'A simple dungeon');
        $room = new \LinkedWorldsCore\Room('A Room', 'A very simple room.');
        $dungeon->addRoom($room);

        $this->assertTrue($dungeon->hasRoom($room));
    }

    public function testRemoveRoom(){
        $dungeon = new \LinkedWorldsCore\Dungeon('Some dungeon', 'A simple dungeon');
        $room = new \LinkedWorldsCore\Room('A Room', 'A very simple room.');
        $dungeon->addRoom($room);
        $dungeon->removeRoom($room);

        $this->assertFalse($dungeon->hasRoom($room));
    }

    public function testAddExitToRoom(){
        $dungeon = new \LinkedWorldsCore\Dungeon('Some dungeon', 'A simple dungeon');
        $room = new \LinkedWorldsCore\Room('A Room', 'A very simple room.');
        $otherRoom = new \LinkedWorldsCore\Room('A Room', 'A very simple room.');

        $dungeon->addRoom($room);
        $dungeon->addRoom($otherRoom);
        $dungeon->addExit($room, $otherRoom, \LinkedWorldsCore\Direction::South);

        $this->assertTrue($dungeon->hasRoom($room));
        $this->assertTrue($dungeon->hasRoom($otherRoom));
        $this->assertTrue($dungeon->hasExit($room, \LinkedWorldsCore\Direction::South));
    }

    public function testRemoveExitFromRoom(){
        $dungeon = new \LinkedWorldsCore\Dungeon('Some dungeon', 'A simple dungeon');
        $room = new \LinkedWorldsCore\Room('A Room', 'A very simple room.');
        $otherRoom = new \LinkedWorldsCore\Room('A Room', 'A very simple room.');

        $dungeon->addRoom($room);
        $dungeon->addRoom($otherRoom);
        $dungeon->addExit($room, $otherRoom, \LinkedWorldsCore\Direction::South);
        $dungeon->removeExit($room, \LinkedWorldsCore\Direction::South);

        $this->assertTrue($dungeon->hasRoom($room));
        $this->assertTrue($dungeon->hasRoom($otherRoom));
        $this->assertFalse($dungeon->hasExit($room, \LinkedWorldsCore\Direction::South));
    }

    public function testRemoveRoomAndExits(){
        // When I remove a room from a dungeon, I expect all exits to that room to be removed as well
        $dungeon = new \LinkedWorldsCore\Dungeon('Some dungeon', 'A simple dungeon');
        $room = new \LinkedWorldsCore\Room('A Room', 'A very simple room.');
        $otherRoom = new \LinkedWorldsCore\Room('A Room', 'A very simple room.');

        $dungeon->addRoom($room);
        $dungeon->addRoom($otherRoom);
        $dungeon->addExit($room, $otherRoom, \LinkedWorldsCore\Direction::South);
        $dungeon->removeRoom($otherRoom);

        $this->assertTrue($dungeon->hasRoom($room));
        $this->assertFalse($dungeon->hasRoom($otherRoom));
        $this->assertFalse($dungeon->hasExit($room, \LinkedWorldsCore\Direction::South));
    }

}
