<?php
/**
 * Provides the list of items the player is currently holding.
 *
 *~ shows the items you are carrying
 *
 * User: Andre LaFleur
 * Date: 5/28/16
 * Time: 10:24 PM
 */

$inventory = $player->getItemList();

$data['response'] = '<div class="response">Your list of items:<br/><br/>';

foreach($inventory as $item)
    $data['response'] .= htmlspecialchars($item) . "<br/>";

$data['response'] .= '</div>';