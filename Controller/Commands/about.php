<?php
/**
 * Describes information about the current dungeon. Or maybe game. I haven't decided.
 *
 * TODO: Decide how the about command will work - does it say anything about the dungeon?
 *
 *~ describes information about this dungeon. Click <a href='../../about.php' target='_blank'>here</a> to learn more about the game as a whole.
 *
 * User: Andre LaFleur
 * Date: 5/29/16
 * Time: 2:28 PM
 */

$dungeon = $player->getCurrentDungeon();
$data['response'] = "<div class='about_dungeon'><i>" . $dungeon->getDungeonName() .
    "</i><br/>Created by " . $dungeon->getDungeonCreator() .
    "<br/><br/>" . $dungeon->getDungeonDescription() . "</div>";