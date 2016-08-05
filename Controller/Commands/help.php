<?php
/**
 * Manages the help command.
 *
 *~ displays this menu
 *
 * User: Andre LaFleur
 * Date: 5/26/16
 * Time: 8:38 PM
 */
// TODO: Set this up to also offer more specific information about each command
foreach(glob('Commands/*.php') as $file) {
    $data['response'] .= '<strong>' . str_replace('Commands/', '', (str_replace('.php', '', $file))) . '</strong> - ';

    $handler = fopen(realpath($file), 'r');
    if($handler){
        $lineExists = false;

        while(($line = fgets($handler)) !== false){
            if(strpos($line, '*~') !== false){
                $data['response'] .= str_replace('*~', '', $line);
                $lineExists = true;
                break;
            }
        }

        if(!$lineExists)
            $data['response'] .= 'no information provided';
    } else {
        $data['response'] .= 'no file found for command';
    }

    $data['response'] .= '<br/>';
}

$data['response'] .= '</div>';