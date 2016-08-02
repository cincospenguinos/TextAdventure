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
$garden = new \LinkedWorldsCore\Room("Garden", "You wake up in a bright and green garden. Thick trees and bushes are scattered all about, " .
    "with fruits of all kinds hanging off of them. There appears to be a beaten path in front of you, descending downward toward the bright " .
    "sun in the east.");
$frontOfHouse = new \LinkedWorldsCore\Room("Front of a House", "You are in front of a white house whose front door is nailed shut. The house appears " .
    "to be abandoned, standing ominously in the dim light of the moon.");
$backOfHouse = new \LinkedWorldsCore\Room("Back of a House", "You are in the back of the house. There is an open window which you can move through by going north.");
$livingRoom = new \LinkedWorldsCore\Room("Living Room", "You are standing inside a living room. The moonlight shines upon the furniture, and exposes a trap door " .
    "in the corner of the room.");
$cellar = new \LinkedWorldsCore\Room("Cellar", "The cool, musty air rests on your shoulders as you descend into the cellar. There are wooden crates cast about the floor. " .
    "You can see dim light emanating further down the cellar.");
$mysticShrine = new \LinkedWorldsCore\Room("Secret Shrine", "You are standing in a room with a dirt floor, dug out through the back wall of the cellar. A stone statue, " .
    "depicting a man holding a strange fruit, stands in the middle of the room.");
$forest = new \LinkedWorldsCore\Room("Forest", "You are standing in a thick forest, where the moon is blocked out due to the tall trees. You see a light southwards in the distance.");
$smallCabin = new \LinkedWorldsCore\Room("Small Cabin", "You are standing in front of a log cabin. Smoke is coming from its chimney. The door is open and there is a passage " .
    "leading downwards inside.");
$library = new \LinkedWorldsCore\Room("Library", "Mountains of ruined tomes flood the room, stacked and stuffed in bookshelves that loom above you.");
$greatHall = new \LinkedWorldsCore\Room("Great Hall", "You are standing in a room that seems to have been a great hall for a king. Rubble blocks the path to the east wing, but a broken " .
    "set of stairs leads upwards to what appears to be a throne room.");
$throneRoom = new \LinkedWorldsCore\Room("Throne Room", "You are standing in front of an altar, in a destroyed thrown room. The altar seems to have been hastily put together, built of stone " .
    "and mud. A portal, infinite and silent, swirls about on the north wall of the room. It beckons you in its silence; move forward only when ready.");

// Put together all of the items.
$strangeFruit = new \LinkedWorldsCore\Item("Strange Fruit", "A fist sized fruit, shaped like a sphere, with a smooth blue skin.");
$strangeFruit->addAlias('fruit');

$artifact = new \LinkedWorldsCore\Item("Artifact", "A small stone statue of a boy wearing an apron, holding a daggar and an acacia twig.");

$tome = new \LinkedWorldsCore\Item("Spell Tome - Spirit Arrow", "A dusty tome describing the method to cast the spell Spirit Arrow.");
$tome->addAlias('tome');
$tome->addAlias('book');
$tome->addAlias('spell book');

// Throw in all the items
$garden->addItem($strangeFruit);
$mysticShrine->addItem($artifact);
$library->addItem($tome);

// Connect all of the rooms
$garden->addExit(\LinkedWorldsCore\Direction::East, $frontOfHouse);

$frontOfHouse->addExit(\LinkedWorldsCore\Direction::South, $backOfHouse);

$backOfHouse->addExit(\LinkedWorldsCore\Direction::East, $frontOfHouse);
$backOfHouse->addExit(\LinkedWorldsCore\Direction::West, $frontOfHouse);
$backOfHouse->addExit(\LinkedWorldsCore\Direction::North, $livingRoom);
$backOfHouse->addExit(\LinkedWorldsCore\Direction::South, $forest);

$livingRoom->addExit(\LinkedWorldsCore\Direction::South, $backOfHouse);
$livingRoom->addExit(\LinkedWorldsCore\Direction::Down, $cellar);

$cellar->addExit(\LinkedWorldsCore\Direction::Up, $livingRoom);
$cellar->addExit(\LinkedWorldsCore\Direction::Down, $mysticShrine);

$mysticShrine->addExit(\LinkedWorldsCore\Direction::Up, $cellar);

$forest->addExit(\LinkedWorldsCore\Direction::North, $backOfHouse);
$forest->addExit(\LinkedWorldsCore\Direction::South, $smallCabin);

$smallCabin->addExit(\LinkedWorldsCore\Direction::North, $forest);
$smallCabin->addExit(\LinkedWorldsCore\Direction::Down, $library);

$library->addExit(\LinkedWorldsCore\Direction::Up, $smallCabin);
$library->addExit(\LinkedWorldsCore\Direction::East, $greatHall);

$greatHall->addExit(\LinkedWorldsCore\Direction::West, $library);
$greatHall->addExit(\LinkedWorldsCore\Direction::Up, $throneRoom);

// Ensure that the dungeon begins at the garden
$dungeon = $garden;