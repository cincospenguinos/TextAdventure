<?php
/**
 * A simple file that is designed to create a full on tutorial dungeon. Promises that the variable $dungeon will be
 * the first room of the tutorial dungeon in its complete form.
 *
 * TODO: Redesign this
 *
 * User: tsvetok
 * Date: 5/28/16
 * Time: 10:30 PM
 */
require_once 'Room.php';
require_once 'Item.php';
require_once 'Direction.php';
require_once 'Monster.php';
require_once 'Dungeon.php';
require_once 'Weapon.php';
require_once 'Attribute.php';

// Create the dungeon
$dungeon = new \LinkedWorldsCore\Dungeon('The World Before', 'גן עדן האבוד', 'יהוה');

// Setup all of the rooms
$garden1 = new \LinkedWorldsCore\Room("Garden", "The ruins of ancient structures lie about, darkened and cracked by time. A trail leads off to the east.");
$garden2 = new \LinkedWorldsCore\Room("Garden", "A large waterfall roars, throwing water down to crash against the rocks. An east-west trail moves along the falls.");
$garden3 = new \LinkedWorldsCore\Room("Garden", "Thick trees and bushes are scattered all about, with fruits of all kinds hanging off of them. The song of birds can be heard in the distance." .
    " You hear the sound of rushing waters to the west. There appears to be a beaten path in front of you, descending downward away from the bright setting sun.");
$frontOfHouse = new \LinkedWorldsCore\Room("Front of a House", "You are in front of a white house whose front door is nailed shut. The house appears " .
    "to be abandoned, standing ominously in the dim light of the moon.");
$backOfHouse = new \LinkedWorldsCore\Room("Back of a House", "You are in the back of the house. There is an open window which you can move through by going north. A long row of " .
    "wide trees with a trail leading into them is south.");
$livingRoom = new \LinkedWorldsCore\Room("Living Room", "You are standing inside a living room. The moonlight shines upon the floor exposing a trap door " .
    "in the corner of the room.");
$cellar = new \LinkedWorldsCore\Room("Cellar", "The cool, musty air rests on your shoulders as you descend into the cellar. You can see dim light emanating further down the cellar.");
$mysticShrine = new \LinkedWorldsCore\Room("Secret Shrine", "You are standing in a room with a dirt floor, dug out through the back wall of the cellar.");
$forest = new \LinkedWorldsCore\Room("Forest", "You are standing in a thick forest, where the moon is blocked out due to the tall trees. You see a light southwards in the distance.");
$smallCabin = new \LinkedWorldsCore\Room("Small Cabin", "You are standing in front of a log cabin. Smoke is coming from its chimney. The door is open and you can see a passage " .
    "leading downwards inside.");
$library = new \LinkedWorldsCore\Room("Library", "Mountains of ruined tomes flood the room, stacked and stuffed in bookshelves that loom above you. A doorway out lies in the east.");
$greatHall = new \LinkedWorldsCore\Room("Great Hall", "You are standing in a room that seems to have been a great hall for a king. Rubble blocks the path to the east wing, but a broken " .
    "set of stairs leads upwards to what appears to be a throne room.");
$throneRoom = new \LinkedWorldsCore\Room("Throne Room", "You are standing in front of an altar, in a destroyed thrown room. The altar seems to have been hastily put together, built of stone " .
    "and mud. A portal, infinite and silent, swirls about on the north wall of the room. It beckons you in its silence; move forward only when ready.");

// Put together all of the items.
$waterfall = new \LinkedWorldsCore\Item("Waterfall", "The falls are huge, dropping tons of water upon the smooth rocks below.", '', false, false);
$waterfall->addAlias('falls');

$rocks = new \LinkedWorldsCore\Item("Rocks", 'The rocks are smoothed over by years and years of the water smashing against it.', '', false, false);
$rocks->addAlias('rock');

$strangeFruit = new \LinkedWorldsCore\Item("Strange Fruit", "A fist sized fruit, shaped like a sphere, with a smooth blue skin.", 'You see a strange looking fruit lying on the ground.');
$strangeFruit->addAlias('fruit');

$artifact = new \LinkedWorldsCore\Item("Artifact", "A small stone statue of a boy wearing an apron, holding a dagger in one hand and an acacia twig in the other.");

$dagger = new \LinkedWorldsCore\Weapon("Dagger", "A rusty dagger with a simple leather handle", 1, 4, 1);
$dagger->setEquipModifier(\LinkedWorldsCore\Attribute::PhysicalToHit, 1);

$tome = new \LinkedWorldsCore\Item("Spell Tome - Spirit Arrow", "A dusty tome describing the method to cast the spell Spirit Arrow.", "You see a spell book, lying open.");
$tome->addAlias('tome');
$tome->addAlias('book');
$tome->addAlias('spell book');
$tome->addAlias('spell tome');

$statue = new \LinkedWorldsCore\Item("Man Statue", "A stone statue of a man holding a fruit in his hand. It is cracked from the right shoulder down to the belly.",
    "A stone statue of a man rests near the far wall.", false, false);
$statue->addAlias('statue');

// Put together some monsters.
$cultist = new \LinkedWorldsCore\Monster([3, 1, 6, 0], 'Cultist', 'A masked humanoid in a dark cloak');
$cultist->giveItem($dagger);
$cultist->equip('dagger');

// Add the monsters
$mysticShrine->addMonster($cultist);

// Throw in all the items
$garden2->addItem($waterfall);
$garden2->addItem($rocks);
$garden3->addItem($strangeFruit);
$mysticShrine->addItem($artifact);
$mysticShrine->addItem($statue);
$library->addItem($tome);

// Add all of the rooms
$dungeon->addRooms([$garden1, $garden2, $garden3, $frontOfHouse, $livingRoom, $backOfHouse, $cellar, $mysticShrine, $forest, $smallCabin, $library, $greatHall, $throneRoom]);

// Connect all of the rooms
$dungeon->addExit($garden1, $garden2, \LinkedWorldsCore\Direction::East);
$dungeon->addExit($garden2, $garden1, \LinkedWorldsCore\Direction::West);
$dungeon->addExit($garden2, $garden3, \LinkedWorldsCore\Direction::East);
$dungeon->addExit($garden3, $garden2, \LinkedWorldsCore\Direction::West);
$dungeon->addExit($garden3, $frontOfHouse, \LinkedWorldsCore\Direction::East);
$dungeon->addExit($frontOfHouse, $backOfHouse, \LinkedWorldsCore\Direction::South);
$dungeon->addExit($backOfHouse, $frontOfHouse, \LinkedWorldsCore\Direction::East);
$dungeon->addExit($backOfHouse, $frontOfHouse, \LinkedWorldsCore\Direction::West);
$dungeon->addExit($backOfHouse, $livingRoom, \LinkedWorldsCore\Direction::North);
$dungeon->addExit($backOfHouse, $forest, \LinkedWorldsCore\Direction::South);
$dungeon->addExit($livingRoom, $backOfHouse, \LinkedWorldsCore\Direction::South);
$dungeon->addExit($livingRoom, $cellar, \LinkedWorldsCore\Direction::Down);
$dungeon->addExit($cellar, $livingRoom, \LinkedWorldsCore\Direction::Up);
$dungeon->addExit($cellar, $mysticShrine, \LinkedWorldsCore\Direction::Down);
$dungeon->addExit($mysticShrine, $cellar, \LinkedWorldsCore\Direction::Up);
$dungeon->addExit($forest, $backOfHouse, \LinkedWorldsCore\Direction::North);
$dungeon->addExit($forest, $smallCabin, \LinkedWorldsCore\Direction::South);
$dungeon->addExit($smallCabin, $forest, \LinkedWorldsCore\Direction::North);
$dungeon->addExit($smallCabin, $library, \LinkedWorldsCore\Direction::Down);
$dungeon->addExit($library, $smallCabin, \LinkedWorldsCore\Direction::Up);
$dungeon->addExit($library, $greatHall, \LinkedWorldsCore\Direction::East);
$dungeon->addExit($greatHall, $library, \LinkedWorldsCore\Direction::West);
$dungeon->addExit($greatHall, $throneRoom, \LinkedWorldsCore\Direction::Up);
$dungeon->addExit($throneRoom, $greatHall, \LinkedWorldsCore\Direction::Down);

// Set the start room
$dungeon->setStartRoom($garden1);