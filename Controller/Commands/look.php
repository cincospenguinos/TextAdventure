<?php
/**
 * Manages the look command in PHP. Grabs the user from APC and does all the shiz they need to.
 *
 * User: tsvetok
 * Date: 5/25/16
 * Time: 9:53 PM
 */

//include_once '../../Model/Game/Player.php';

$data['response'] = htmlspecialchars($player->look());