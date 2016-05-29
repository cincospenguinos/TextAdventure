<?php
/**
 * A simple file that is designed to create a full on tutorial dungeon. Promises that the variable $dungeon will be
 * the first room of the tutorial dungeon in its complete form.
 *
 * User: tsvetok
 * Date: 5/28/16
 * Time: 10:30 PM
 */
require_once 'Room.php';
require_once 'Item.php';
require_once 'Direction.php';

// Define the rooms
$house = new \LinkedWorldsCore\Room('Front of a House', 'You are in front of a white house with a door that is nailed shut. The
entire house is surrounded by a thick forest.');
$woods = new \LinkedWorldsCore\Room('Woods', 'You are in the middle of a shady forest.');
$woodsClearing = new \LinkedWorldsCore\Room('Woods', 'You are in a clearing in the forest. There is an open grate, surrounded
by concrete.');
$cellar = new \LinkedWorldsCore\Room('Cellar', 'You are within what seems to be a cellar of the house. A musty smell fills the room
 as you step into the dust on the floor.');
$shrine = new \LinkedWorldsCore\Room('Mysterious Shrine', 'You discover a strange shrine deep inside the cellar. The room is dimly lit
 by long candles. Someone was here recently.');

// Define the objects and place them where they need to be
$artifact = new \LinkedWorldsCore\Item('Strange Artifact', 'A small stone statue of a man holding a bow in one hand and an olive branch in the other.');
$artifact->addAlias('artifact');
$shrine->addItem($artifact);

// Connect all the rooms
$house->addExit(\LinkedWorldsCore\Direction::East, $woods);
$woods->addExit(\LinkedWorldsCore\Direction::West, $house);
$woods->addExit(\LinkedWorldsCore\Direction::South, $woodsClearing);
$woods->addExit(\LinkedWorldsCore\Direction::North, $house);
$woods->addExit(\LinkedWorldsCore\Direction::West, $woods);
$woodsClearing->addExit(\LinkedWorldsCore\Direction::NorthWest, $woods);
$woodsClearing->addExit(\LinkedWorldsCore\Direction::Down, $cellar);
$cellar->addExit(\LinkedWorldsCore\Direction::Up, $woodsClearing);
$cellar->addExit(\LinkedWorldsCore\Direction::Down, $shrine);
$shrine->addExit(\LinkedWorldsCore\Direction::Up, $cellar);

// Set the dungeon.
$dungeon = $house;