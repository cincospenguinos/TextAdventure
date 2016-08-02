<?php

/**
 * Created by PhpStorm.
 * User: tsvetok
 * Date: 5/29/16
 * Time: 1:51 PM
 */
include_once '../Direction.php';

class DirectionTest extends PHPUnit_Framework_TestCase
{

    /**
     * Direction::toDirection($string) should return a numeric value where it is proper.
     */
    public function testToDirection(){
        $answers = [
            'north' => 0,
            'n' => 0,
            'northeast' => 1,
            'ne' => 1,
            'east' => 2,
            'e' => 2,
            'southeast' => 3,
            'se' => 3,
            'south' => 4,
            's' => 4,
            'southwest' => 5,
            'sw' => 5,
            'west' => 6,
            'w' => 6,
            'northwest' => 7,
            'nw' => 7,
            'up' => 8,
            'u' => 8,
            'down' => 9,
            'd' => 9
        ];
        $correctTestStrings = ['north', 'n', 'south', 'sw', 'nw', 'northwest', 'northeast'];
        $incorrectTestStrings = ['nrth', 'south west', 'swa', 'poop', 'some other third thing'];

        foreach($correctTestStrings as $testString){
            $result = \LinkedWorldsCore\Direction::toDirection($testString);

            $this->assertTrue(!is_null($result));
            $this->assertTrue($answers[$testString] === $result);
        }

        foreach($incorrectTestStrings as $testString){
            $result = \LinkedWorldsCore\Direction::toDirection($testString);

            $this->assertTrue(is_null($result));
        }
    }
}
