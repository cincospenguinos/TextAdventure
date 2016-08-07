<?php

/**
 * Created by PhpStorm.
 * User: tsvetok
 * Date: 8/7/16
 * Time: 10:28 AM
 */
require '../Attribute.php';

class AttributeTest extends PHPUnit_Framework_TestCase
{
    /**
     * Modifier of less than 5 should be negative
     */
    public function testNegativeModifierTest(){
        $modifier = \LinkedWorldsCore\Attribute::getModifier(3);
        $this->assertTrue($modifier < 0);
        $this->assertTrue($modifier == -1);
        $modifier = \LinkedWorldsCore\Attribute::getModifier(1);
        $this->assertTrue($modifier < 0);
        $this->assertTrue($modifier == -2);
    }

    /**
     * Modifier of 5 or 6 should be zero
     */
    public function testZeroModifierTest(){
        $modifier = \LinkedWorldsCore\Attribute::getModifier(5);
        $this->assertTrue($modifier == 0, "Was $modifier");
        $modifier = \LinkedWorldsCore\Attribute::getModifier(6);
        $this->assertTrue($modifier == 0, "Was $modifier");
    }

    /**
     * Modifier of more than 6 should be positive
     */
    public function testPositiveModifierTest(){
        $modifier = \LinkedWorldsCore\Attribute::getModifier(7);
        $this->assertTrue($modifier > 0, "Was $modifier");
        $this->assertTrue($modifier == 1);
        $modifier = \LinkedWorldsCore\Attribute::getModifier(11);
        $this->assertTrue($modifier > 0);
        $this->assertTrue($modifier == 3);
    }

    /**
     * A modifier of 0 should always be -3
     */
    public function testAbsoluteBottomModifier(){
        $modifier = \LinkedWorldsCore\Attribute::getModifier(0);
        $this->assertTrue($modifier == -3);
    }

}
