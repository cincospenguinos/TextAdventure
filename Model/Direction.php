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
}