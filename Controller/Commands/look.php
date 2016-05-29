<?php
/**
 * Manages the look command in PHP. Grabs the user from APC and does all the shiz they need to.
 *
 * User: Andre LaFleur
 * Date: 5/25/16
 * Time: 9:53 PM
 */

if(strpos($command, 'look at') !== false){
    $item = str_replace('look at ', '', $command);
    $data['response'] = htmlspecialchars($player->lookAt($item));
} else {
    $data['response'] = htmlspecialchars($player->look());
}