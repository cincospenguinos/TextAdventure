<?php
/**
 * Created by PhpStorm.
 * User: tsvetok
 * Date: 5/24/16
 * Time: 9:50 PM
 */

include_once '../Item.php';

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
}
