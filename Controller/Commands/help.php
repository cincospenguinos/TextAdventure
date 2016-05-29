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

//$data['response'] = '<strong>about</strong> - provides information about this game<br/>
//<strong>look</strong> - describes the area you are currently in<br/>
//<strong>look at [item]</strong> - provides the description of the item provided<br/>
//<strong>help</strong> - shows this list of commands<br/>
//<strong>go [direction]</strong> - allows you to go up, down, or any of the compass directions <br/>
//<strong>take [item]</strong> - pick up an item in the current room you are in<br/>
//<strong>drop [item]</strong> - drop an item you are currently holding<br/>
//<strong>inventory</strong> - list the things you are currently holding<br/>';