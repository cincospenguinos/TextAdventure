<?php
/**
 * Manages the help command.
 *
 *~ displays this menu
 *# <strong>help</strong> displays the list of commands. Type <strong>help [command]</strong> for information on a specific command
 *
 * User: Andre LaFleur
 * Date: 5/26/16
 * Time: 8:38 PM
 */
// TODO: Set this up to also offer more specific information about each command
$helpCommand = explode(' ', strtolower($command));
error_log("[DEBUG] The helpCommand array: " . print_r($helpCommand, true));

$data['response'] = '<div class="help_response">';
if(sizeof($helpCommand) === 1){
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
} else {
    $helpCommand = $helpCommand[1]; // This is the command we are going to provide more information about

    foreach(glob('Commands/*.php') as $file) {
        $isFile = strpos($file, $helpCommand) !== false;
        error_log("[DEBUG] Is it {$file}? {$isFile}");

        if(strpos($file, $helpCommand) !== false) {
            $handler = fopen(realpath($file), 'r');
            error_log("[DEBUG] Found the proper command!");
            if($handler){
                $lineExists = false;

                while(($line = fgets($handler)) !== false){
                    if(strpos($line, '*#') !== false){
                        $data['response'] = str_replace('*#', '', $line);
                        error_log("[DEBUG] Response: {$data['response']}");
                        $lineExists = true;
                        break;
                    }
                }

                if($lineExists)
                    break;
            }
        }

//        $data['response'] = 'no information was found on that command';
    }
}

$data['response'] .= '</div>';