<?php
/**
 * This is a temporary file to play around with making AJAX calls to the backend from the front end.
 *
 * User: tsvetok
 * Date: 5/25/16
 * Time: 5:22 PM
 */
$data = [];
$data['result'] = 'success';
$data['response'] = 'You see a room.';
$jsonData = json_encode($data);
echo $jsonData;