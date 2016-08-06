<?php
/**
 * Created by PhpStorm.
 * User: tsvetok
 * Date: 5/24/16
 * Time: 9:50 PM
 */

require_once '../Room.php';

class RoomTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test the constructor
     */
    public function testConstructor(){
        $room = new \LinkedWorldsCore\Room('A Room', 'A very simple room.');
    }

    /**
     * When I add an item into the room, I expect the item to be there.
     */
    public function testItemIsInRoom(){
        $room = new \LinkedWorldsCore\Room('A Room', 'A very simple room.');
        $room->addItem(new \LinkedWorldsCore\Item('Item', 'A very simple item.'));
        $this->assertTrue($room->hasItem('Item'));
    }

    /**
     * When I add an item into a room, I expect it to be there and I can check by its alias.
     */
    public function testItemIsInRoomByAlias(){
        $room = new \LinkedWorldsCore\Room('A Room', '');
        $item = new \LinkedWorldsCore\Item('Key of Gondor', '');
        $item->addAlias('key');
        $room->addItem($item);

        $this->assertTrue($room->hasItem('key'));
    }

    /**
     * When an item is not in a room, I should not be told that it is
     */
    public function testItemIsNotInRoom(){
        $room = new \LinkedWorldsCore\Room('A Room', 'A very simple room.');
        $this->assertFalse($room->hasItem('Item'));
        $room->addItem(new \LinkedWorldsCore\Item('Item', 'A very simple item.'));
        $this->assertTrue($room->hasItem('Item'));
    }

    /**
     * When I remove an item from a room, I should get that item back and the item
     * should no longer be in the room.
     */
    public function testItemIsRemovedFromRoom(){
        $room = new \LinkedWorldsCore\Room('A Room', 'A very simple room.');
        $room->addItem(new \LinkedWorldsCore\Item('Item', 'A very simple item.'));

        $this->assertTrue($room->hasItem('Item'));

        $item = $room->removeItem('Item');

        $this->assertFalse($room->hasItem('Item'));
        $this->assertFalse(is_null($item));
        $this->assertTrue(strcmp($item->getName(), 'Item') === 0);
    }

    /**
     * When I attempt to look at an item in the room by its alias, I expect to be
     * given the description of that item.
     */
    public function testLookAtItemInRoomByAlias(){
        $room = new \LinkedWorldsCore\Room('A Room', 'A very simple room.');
        $item = new \LinkedWorldsCore\Item('Item', 'A very simple item.');
        $item->addAlias('thing');
        $room->addItem($item);

        $result = $room->lookAt('thing');
        $this->assertFalse(is_null($result));
        $this->assertTrue(strcmp($result, 'A very simple item.') === 0);
    }
}
