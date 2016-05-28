<?php
/**
 * Creation of the tutorial dungeon.
 *
 * User: tsvetok
 * Date: 5/28/16
 * Time: 2:58 PM
 */
include_once 'Game/Room.php';
include_once 'Game/Item.php';

$room = new \LinkedWorldsCore\Room('Room 1', 'The first room.');
$room->addExit(\LinkedWorldsCore\Direction::East, new \LinkedWorldsCore\Room('Room 2', 'The second room.'));
$otherRoom = new \LinkedWorldsCore\Room('Room 3', 'The third room');
$otherRoom->addItem(new \LinkedWorldsCore\Item('Some item', 'Some item on the floor'));
$otherRoom->addExit(\LinkedWorldsCore\Direction::South, $room);
$room->addExit(\LinkedWorldsCore\Direction::South, $otherRoom);