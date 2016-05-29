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
require_once '../Item.php';

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

    public function testHasItem(){
        $this->playerOne->giveItem(new \LinkedWorldsCore\Item('Item', 'description'));
        $this->assertTrue($this->playerOne->hasItem('Item'));
    }

    /**
     * When I look at an item and the name of the item matches an item in my inventory, I should
     * receive the description of that item.
     */
    public function testLookAtItemInInventory(){
        $this->playerOne->giveItem(new \LinkedWorldsCore\Item('Item', 'description'));
        $this->assertTrue($this->playerOne->hasItem('Item'));
        
        $description = $this->playerOne->lookAt('Item');
        $this->assertTrue(strcmp($description, 'description') === 0);
    }

    /**
     * When I look at an item and it is in the room instead of in my inventory, I should receive
     * a description of that item.
     */
    public function testLookAtItemInRoom(){
        $this->dungeonOne->addItem(new \LinkedWorldsCore\Item('Item', 'description'));
        $description = $this->playerOne->lookAt('Item');

        $this->assertFalse(is_null($description));
        $this->assertTrue(strcmp($description, 'description') === 0);
    }

    /**
     * When I attempt to look at an item that does not exist, I'm given null instead of a description.
     */
    public function testLookAtItemThatDoesNotExist(){
        $description = $this->playerOne->lookAt('Item');
        $this->assertTrue(is_null($description));
    }

    /**
     * When I pick up an item in the dungeon, I expect the item to be in my inventory and not on the floor
     * in the dungeon.
     */
    public function testPickUpItem(){
        $this->dungeonOne->addItem(new \LinkedWorldsCore\Item('Item', 'description'));
        $this->playerOne->takeItem('iTem'); // The item should still be obtained regardless of case

        $this->assertTrue($this->playerOne->hasItem('iteM'));
        $this->assertFalse($this->dungeonOne->hasItem('Item'));
    }

    /**
     * When I pick up an item in the dungeon, I can pick it up by use of its alias, regardless of the actual
     * name of the item.
     */
    public function testPickUpItemByAlias(){
        $item = new \LinkedWorldsCore\Item('Key of Gondor', 'The key belonging to the King of Gondor.');
        $item->addAlias('key');
        $this->dungeonOne->addItem($item);
        $this->playerOne->takeItem('key');

        $this->assertTrue($this->playerOne->hasItem('Key of Gondor'));
        $this->assertTrue($this->playerOne->hasItem('key'));
    }

    /**
     * When I attempt to look at an item in the world, I expect to be given the description if I use one of
     * its aliases.
     */
    public function testLookAtItemByAlias() {
        $item = new \LinkedWorldsCore\Item('Key of Gondor', 'Some important key.');
        $item->addAlias('key');
        $this->dungeonOne->addItem($item);
        $result = $this->playerOne->lookAt('key');

        $this->assertFalse(is_null($result));
        $this->assertTrue(strcmp($result, 'Some important key.') === 0);
    }
}