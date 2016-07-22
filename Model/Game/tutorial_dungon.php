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

// Setup all of the rooms
$frontOfHouse = new \LinkedWorldsCore\Room('Front of White House', 'You are in front of a white house. Its front door is nailed shut.');
$backOfHouse = new \LinkedWorldsCore\Room('Back of White House', 'You are in back of a white house. A window into it is open.');
$houseKitchen = new \LinkedWorldsCore\Room('Kitchen', 'You are inside a simple kitchen, with bare cupboards and shelves.');
$cellar = new \LinkedWorldsCore\Room('Cellar', 'You are in the cellar of the house. The air is cold and damp. You can see a dim light shimmering to the south west.');
$shrine = new \LinkedWorldsCore\Room('Shrine', 'You are in front of a shrine. Long, slender white candles light the room.');
$forestA = new \LinkedWorldsCore\Room('Forest', 'You are in a thick forest with branches all around you.');
$forestB = new \LinkedWorldsCore\Room('Forest', 'You are in a thick forest with branches all around you.');
$clearing = new \LinkedWorldsCore\Room('Clearing', 'You are standing in a clearing in the forest. You see an old stone well with what seems to be a ladder leading down inside it. You can hear the sound of crashing water from the south.');
$waterfall = new \LinkedWorldsCore\Room('Waterfall', 'You are at the base of a waterfall. The cold water splashes and roars loudly in your ears.');
$cliff = new \LinkedWorldsCore\Room('Cliff', 'You are standing on a cliff next to the waterfall.');
$ravine = new \LinkedWorldsCore\Room('Large Ravine', 'You are in front of a large ravine, stretching far away. There is a bridge here that you can use to cross it.');
$otherCliff = new \LinkedWorldsCore\Room('Cliff', 'You are standing at the cliff of a ravine. A slick, muddy slope leads towards the forest.');
$darkLibrary = new \LinkedWorldsCore\Room('Dark Library', 'You are in what appears to be a library. The light is dim and books are stacked in high bookshelves.');
$hallwayA = new \LinkedWorldsCore\Room('Hallway', 'You are in a regal looking hallway.');
$kingdomKitchen = new \LinkedWorldsCore\Room('Kitchen', 'You are standing in a fancy kitchen, with all sorts of cooking equipment.');
$banquetHall = new \LinkedWorldsCore\Room('Banquet Hall', 'You are in a bright banquet hall, with long oak tables and large, ornate chairs.');
$mainHall = new \LinkedWorldsCore\Room('Main Hall', 'You are in a large, open room, in which guests fill with royal dances.');
$hallwayB = new \LinkedWorldsCore\Room('Hallway', 'You are in a regal looking hallway.');
$smallBedroom = new \LinkedWorldsCore\Room('Small Bedroom', 'You are standing in a small bedroom with a simple set of furniture.');
$altar = new \LinkedWorldsCore\Room('Altar', 'You are standing in front of an altar, carved out of stone. The walls have carvings in them of mighty hands and wicked creatures.');

// Put together all of the items.
$artifact = new \LinkedWorldsCore\Item('small artifact', 'A small statue of a young boy holding a club in one hand and an olive branch in the other.');
$artifact->addAlias('artifact');

$bookOfIncantations = new \LinkedWorldsCore\Item('Book of Incantations', 'It looks heavy and old, with yellowing pages and a damaged cover.');
$bookOfIncantations->addAlias('book');

$club = new \LinkedWorldsCore\Item('Club', 'A heavy wooden club, neither carved nor extravagant. It\'s barely more than a stick, to be honest.', true);

// Throw in all the items
$otherCliff->addItem($bookOfIncantations);
$shrine->addItem($artifact);
$houseKitchen->addItem($club);

// Connect all of the rooms
$frontOfHouse->addExit(\LinkedWorldsCore\Direction::South, $backOfHouse);
$frontOfHouse->addExit(\LinkedWorldsCore\Direction::East, $forestA);
$backOfHouse->addExit(\LinkedWorldsCore\Direction::West, $frontOfHouse);
$backOfHouse->addExit(\LinkedWorldsCore\Direction::North, $houseKitchen);
$backOfHouse->addExit(\LinkedWorldsCore\Direction::East, $forestA);
$houseKitchen->addExit(\LinkedWorldsCore\Direction::South, $backOfHouse);
$houseKitchen->addExit(\LinkedWorldsCore\Direction::Down, $cellar);
$cellar->addExit(\LinkedWorldsCore\Direction::Up, $houseKitchen);
$cellar->addExit(\LinkedWorldsCore\Direction::SouthWest, $shrine);
$shrine->addExit(\LinkedWorldsCore\Direction::NorthEast, $cellar);
$forestA->addExit(\LinkedWorldsCore\Direction::West, $frontOfHouse);
$forestA->addExit(\LinkedWorldsCore\Direction::South, $forestB);
$forestA->addExit(\LinkedWorldsCore\Direction::East, $forestA);
$forestB->addExit(\LinkedWorldsCore\Direction::West, $forestA);
$forestB->addExit(\LinkedWorldsCore\Direction::East, $forestA);
$forestB->addExit(\LinkedWorldsCore\Direction::South, $clearing);
$clearing->addExit(\LinkedWorldsCore\Direction::SouthWest, $forestB);
$clearing->addExit(\LinkedWorldsCore\Direction::Down, $darkLibrary);
$clearing->addExit(\LinkedWorldsCore\Direction::South, $waterfall);
$waterfall->addExit(\LinkedWorldsCore\Direction::NorthWest, $clearing);
$waterfall->addExit(\LinkedWorldsCore\Direction::Up, $cliff);
$cliff->addExit(\LinkedWorldsCore\Direction::South, $waterfall);
$cliff->addExit(\LinkedWorldsCore\Direction::West, $ravine);
$ravine->addExit(\LinkedWorldsCore\Direction::East, $cliff);
$ravine->addExit(\LinkedWorldsCore\Direction::West, $otherCliff);
$otherCliff->addExit(\LinkedWorldsCore\Direction::East, $ravine);
$otherCliff->addExit(\LinkedWorldsCore\Direction::Down, $forestA);
$darkLibrary->addExit(\LinkedWorldsCore\Direction::Up, $clearing);
$darkLibrary->addExit(\LinkedWorldsCore\Direction::West, $hallwayA);
$hallwayA->addExit(\LinkedWorldsCore\Direction::East, $darkLibrary);
$hallwayA->addExit(\LinkedWorldsCore\Direction::South, $kingdomKitchen);
$hallwayA->addExit(\LinkedWorldsCore\Direction::West, $mainHall);
$kingdomKitchen->addExit(\LinkedWorldsCore\Direction::North, $hallwayA);
$kingdomKitchen->addExit(\LinkedWorldsCore\Direction::West, $banquetHall);
$mainHall->addExit(\LinkedWorldsCore\Direction::East, $hallwayA);
$mainHall->addExit(\LinkedWorldsCore\Direction::South, $banquetHall);
$mainHall->addExit(\LinkedWorldsCore\Direction::West, $hallwayB);
$mainHall->addExit(\LinkedWorldsCore\Direction::North, $altar);
$altar->addExit(\LinkedWorldsCore\Direction::South, $mainHall);
$banquetHall->addExit(\LinkedWorldsCore\Direction::North, $mainHall);
$banquetHall->addExit(\LinkedWorldsCore\Direction::East, $kingdomKitchen);
$banquetHall->addExit(\LinkedWorldsCore\Direction::West, $hallwayB);
$hallwayB->addExit(\LinkedWorldsCore\Direction::South, $banquetHall);
$hallwayB->addExit(\LinkedWorldsCore\Direction::East, $mainHall);
$hallwayB->addExit(\LinkedWorldsCore\Direction::West, $smallBedroom);
$smallBedroom->addExit(\LinkedWorldsCore\Direction::East, $hallwayB);

// Ensure that the dungeon begins at the front of the house
$dungeon = $frontOfHouse;