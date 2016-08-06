<?php
/**
 * Created by PhpStorm.
 * User: tsvetok
 * Date: 5/24/16
 * Time: 9:49 PM
 */

require_once '../Dungeon.php';
require_once '../Room.php';
require_once '../Player.php';
require_once '../Direction.php';
require_once '../Item.php';
require_once '../Weapon.php';

class PlayerTest extends \PHPUnit_Framework_TestCase
{
    // TODO: Redo all of the tests
    // TODO: Add tests for equipping/unequipping weapons
    private $playerOne, $dungeonOne;

    public function setUp(){
        $this->dungeonOne = new \LinkedWorldsCore\Dungeon("Dungeon", "A simple dungeon.", "Someone important");
        $room = new LinkedWorldsCore\Room("Room 1", "This is the first room.");
        $otherRoom = new \LinkedWorldsCore\Room("Room 2", "This is the second room.");

        $this->dungeonOne->addRooms([$room, $otherRoom]);
        $this->dungeonOne->addExit($room, $otherRoom, \LinkedWorldsCore\Direction::East);
        $this->dungeonOne->addExit($otherRoom, $room, \LinkedWorldsCore\Direction::West);
        $this->dungeonOne->setStartRoom($room);

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
        $player = new \LinkedWorldsCore\Player('Player', $this->dungeonOne);
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
        $this->dungeonOne->getStartRoom()->addItem(new \LinkedWorldsCore\Item('Item', 'description'));
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
        $this->dungeonOne->getStartRoom()->addItem(new \LinkedWorldsCore\Item('Item', 'description'));
        $this->playerOne->takeItem('iTem'); // The item should still be obtained regardless of case

        $this->assertTrue($this->playerOne->hasItem('iteM'));
        $this->assertFalse($this->dungeonOne->getStartRoom()->hasItem('Item'));
    }

    /**
     * When I pick up an item in the dungeon, I can pick it up by use of its alias, regardless of the actual
     * name of the item.
     */
    public function testPickUpItemByAlias(){
        $item = new \LinkedWorldsCore\Item('Key of Gondor', 'The key belonging to the King of Gondor.');
        $item->addAlias('key');
        $this->playerOne->getCurrentRoom()->addItem($item);
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
        $this->playerOne->getCurrentRoom()->addItem($item);
        $result = $this->playerOne->lookAt('key');

        $this->assertFalse(is_null($result));
        $this->assertTrue(strcmp($result, 'Some important key.') === 0);
    }

    /**
     * When I attempt to drop an item by its alias, I should be able to drop it.
     */
    public function testDropItemByAlias(){
        $item = new \LinkedWorldsCore\Item('Writing Implement', 'A simple writing implement.');
        $item->addAlias('implement');
        $item->addAlias('pencil');
        $this->playerOne->giveItem($item);
        $result = $this->playerOne->dropItem('implement');

        $this->assertTrue($result);
        $this->assertFalse($this->playerOne->hasItem('writing implement'));
        $this->assertFalse($this->playerOne->hasItem('implement'));
        $this->assertFalse($this->playerOne->hasItem('pencil'));

        $this->assertTrue($this->playerOne->getCurrentRoom()->hasItem('pencil'));
        $this->assertTrue($this->playerOne->getCurrentRoom()->hasItem('writing implement'));
        $this->assertTrue($this->playerOne->getCurrentRoom()->hasItem('implement'));
    }

    /**
     * When I attempt to pick up an item that is not available, I should be told I cannot.
     */
    public function testPickUpEnvironmentItem(){
        $item = new \LinkedWorldsCore\Item('Writing Implement', 'A simple writing implement.', null, false, false);
        $this->playerOne->getCurrentRoom()->addItem($item);

        $this->assertTrue(is_string($this->playerOne->takeItem('Writing Implement')));
    }

    /**
     * When I attempt to equip an item, I expect that it will be equipped.
     */
    public function testEquipItem(){
        $item = new \LinkedWorldsCore\Item('Pendant', 'A pendant.', null, true, true);
        $this->playerOne->getCurrentRoom()->addItem($item);
        $this->playerOne->takeItem('pendant');
        $this->assertTrue($this->playerOne->hasItem('pendant'));

        $hasEquipped = $this->playerOne->equip('pendant');

        $this->assertFalse(is_string($hasEquipped));
    }

    /**
     * When I attempt to equip an item that is not able to be equipped, I expect to be told that that is the case.
     */
    public function testCannotEquipItem(){
        $item = new \LinkedWorldsCore\Item('Object', 'An object', null);
        $this->playerOne->getCurrentRoom()->addItem($item);
        $this->assertTrue(is_string($this->playerOne->equip('object')));
        $this->playerOne->takeItem('object');
        $this->assertTrue(is_string($this->playerOne->equip('object')));
    }

    /**
     * When I attempt to unequip an item, I expect that it will be unequipped.
     */
    public function testUnequipItem(){
        $item = new \LinkedWorldsCore\Item('Pendant', 'A pendant.', null, true, true);
        $this->playerOne->getCurrentRoom()->addItem($item);
        $this->playerOne->takeItem('pendant');
        $this->assertTrue($this->playerOne->hasItem('pendant'));

        $hasEquipped = $this->playerOne->equip('pendant');

        $this->assertFalse(is_string($hasEquipped));
        $this->assertTrue($this->playerOne->unequip('pendant'));
        $this->assertFalse(in_array('pendant', $this->playerOne->getEquippedItemNames()));
    }

    public function testEquipItemWithBonuses(){
        $item = new \LinkedWorldsCore\Item('Pendant', 'A pendant.', null, true, true);
        $item->setEquipModifier(\LinkedWorldsCore\Attribute::Constitution, 2);
        $this->playerOne->getCurrentRoom()->addItem($item);

        $preCon = $this->playerOne->getConstitution();
        $this->playerOne->takeItem('pendant');
        $this->playerOne->equip('pendant');
        $postCon = $this->playerOne->getConstitution();

        $this->assertTrue($preCon !== $postCon);
    }

    /**
     * When I attempt to equip a weapon, I expect to be equipped.
     */
    public function testEquipWeapon(){
        $weapon = new \LinkedWorldsCore\Weapon('Dagger', 'A simple daggar.', 1, 6, 1);
        $this->playerOne->giveItem($weapon);

        $preDamage = $this->playerOne->maxPhysicalDamage();
        $this->playerOne->equip('Dagger');
        $postDamage = $this->playerOne->maxPhysicalDamage();

        $this->assertTrue($preDamage !== $postDamage);
    }
}