<?php
/**
 * Created by PhpStorm.
 * User: tsvetok
 * Date: 5/24/16
 * Time: 9:50 PM
 */

require_once '../Item.php';
require_once '../Attribute.php';

class ItemTest extends \PHPUnit_Framework_TestCase
{

    public function testConstructor(){
        $item = new \LinkedWorldsCore\Item('Item', 'An item.');
    }

    /**
     * When I add an alias to an item, that item is recognized as such.
     */
    public function testAddAlias(){
        $item = new \LinkedWorldsCore\Item('Key of Gondor', 'Key belonging to the king of Gondor.');
        $item->addAlias('key');

        $this->assertTrue($item->hasAlias('key'));
    }

    /**
     * When I add a modifier to an item, I expect it to be there.
     */
    public function testAddModifier(){
        $item = new \LinkedWorldsCore\Item('Sword', 'A generic fantasy sword.', true);
        $item->setEquipModifier(\LinkedWorldsCore\Attribute::MaxHitPoints, 3);

        $this->assertTrue($item->hasEquipModifier(\LinkedWorldsCore\Attribute::MaxHitPoints));
        $this->assertFalse($item->hasEquipModifier(\LinkedWorldsCore\Attribute::Dexterity));
        $this->assertTrue($item->getEquipModifier(\LinkedWorldsCore\Attribute::MaxHitPoints) === 3);
    }

    /**
     * When I remove a modifier from an item, I expect it to be gone.
     */
    public function testRemoveModifier(){
        $item = new \LinkedWorldsCore\Item('Club', 'A generic fantasy club.', true);
        $item->setEquipModifier(\LinkedWorldsCore\Attribute::Dexterity, -1);

        $this->assertTrue($item->hasEquipModifier(\LinkedWorldsCore\Attribute::Dexterity));
        $this->assertTrue($item->getEquipModifier(\LinkedWorldsCore\Attribute::Dexterity) === -1);

        $item->removeEquipModifier(\LinkedWorldsCore\Attribute::Dexterity);
        $this->assertFalse($item->hasEquipModifier(\LinkedWorldsCore\Attribute::Dexterity));
    }
}