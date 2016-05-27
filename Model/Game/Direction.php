<?php
/**
 * A pseudo "enum" that basically differentiates between each of the directions the player can go.
 *
 * User: tsvetok
 * Date: 5/24/16
 * Time: 8:51 PM
 */

namespace LinkedWorldsCore;


abstract class Direction
{
    const North = 0;
    const NorthEast = 1;
    const East = 2;
    const SouthEast = 3;
    const South = 4;
    const SouthWest = 5;
    const West = 6;
    const NorthWest = 7;
    const Up = 8;
    const Down = 9;

    /**
     * Gives a string given the direction provided. $direction must be numeric.
     *
     * @param $direction
     * @return string
     * @throws \TypeError
     */
    public static function toString($direction){
        if(!is_numeric($direction))
            throw new \TypeError('$direction must be a numeric value!');

        switch($direction){
            case 0:
                return 'north';
            case 1:
                return 'northeast';
            case 2:
                return 'east';
            case 3:
                return 'southeast';
            case 4:
                return 'south';
            case 5:
                return 'southwest';
            case 6:
                return 'west';
            case 7:
                return 'northwest';
            case 8:
                return 'up';
            case 9:
                return 'down';
            default:
                throw new \RuntimeException("No string value found for $direction");
        }
    }
}