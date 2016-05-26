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
        $this->assertTrue(strcmp($item->getItemName(), 'Item') === 0);
    }

}
