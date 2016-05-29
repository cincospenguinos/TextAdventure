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
            throw new \RuntimeException("The thing passed is not a numeric direction!");

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

    /**
     * Returns an integer matching the string provided, or null if none exists.
     *
     * @param $directionString
     * @return int|null
     */
    public static function toDirection($directionString){
        switch(true){
            case stristr($directionString, 'north'):
            case stristr($directionString, 'n'):
                return 0;
            case stristr($directionString, 'northeast'):
            case stristr($directionString, 'ne'):
                return 1;
            case stristr($directionString, 'east'):
            case stristr($directionString, 'e'):
                return 2;
            case stristr($directionString, 'southeast'):
            case stristr($directionString, 'se'):
                return 3;
            case stristr($directionString, 'south'):
            case stristr($directionString, 's'):
                return 4;
            case stristr($directionString, 'southwest'):
            case stristr($directionString, 'sw'):
                return 5;
            case stristr($directionString, 'west'):
            case stristr($directionString, 'w'):
                return 6;
            case stristr($directionString, 'northwest'):
            case stristr($directionString, 'nw'):
                return 7;
            case stristr($directionString, 'up'):
            case stristr($directionString, 'u'):
                return 8;
            case stristr($directionString, 'down'):
            case stristr($directionString, 'd'):
                return 9;
            default:
                return null;
        }
    }

    /**
     * Indicates whether or not the given direction string is an acceptable one or not.
     *
     * @param $directionString
     * @return bool
     */
    public static function isDirectionString($directionString){
        switch(true){
            case (strcasecmp($directionString, 'north') === 0):
            case (strcasecmp($directionString, 'northeast') === 0):
            case (strcasecmp($directionString, 'east') === 0):
            case (strcasecmp($directionString, 'southeast') === 0):
            case (strcasecmp($directionString, 'south') === 0):
            case (strcasecmp($directionString, 'southwest') === 0):
            case (strcasecmp($directionString, 'west') === 0):
            case (strcasecmp($directionString, 'northwest') === 0):
            case (strcasecmp($directionString, 'n') === 0):
            case (strcasecmp($directionString, 'ne') === 0):
            case (strcasecmp($directionString, 'e') === 0):
            case (strcasecmp($directionString, 'se') === 0):
            case (strcasecmp($directionString, 's') === 0):
            case (strcasecmp($directionString, 'sw') === 0):
            case (strcasecmp($directionString, 'w') === 0):
            case (strcasecmp($directionString, 'nw') === 0):
            case (strcasecmp($directionString, 'up') === 0):
            case (strcasecmp($directionString, 'down') === 0):
            case (strcasecmp($directionString, 'u') === 0):
            case (strcasecmp($directionString, 'd') === 0):
                return true;
            default:
                return false;
        }
    }
}