<?php

/**
 * A series of static methods to help manage the play system.
 *
 * User: tsvetok
 * Date: 5/28/16
 * Time: 9:29 PM
 */
include_once 'Game/Direction.php';

class Parser
{
    /**
     * Returns the arch command string from the human input provided.
     *
     * @param $humanInput
     * @return string|null
     */
    public static function getArchCommand($humanInput){
        $humanInput = self::removeArticles($humanInput);
        $humanInput = strtolower($humanInput);
        $command = explode(' ', $humanInput)[0];

        // At this point, we just need to look at the first thing and return what it is
        switch(true){
            case (strcmp($command, 'look') === 0):
                return 'look';
            case (strcmp($command, 'help') === 0):
                return 'help';
            case(\LinkedWorldsCore\Direction::isDirectionString($command)):
            case (strcmp($command, 'go') === 0):
                return 'go';
            case (strcmp($command, 'take') === 0):
            case (strcmp($command, 'get') === 0):
                return 'take';
            case (strcmp($command, 'login') === 0):
                return 'login';
            case (strcmp($command, 'drop') === 0):
                return 'drop';
            case (strcmp($command, 'inventory') === 0):
            case (strcmp($command, 'inv') === 0):
                return 'inventory';
            case (strcmp($command, 'about') === 0):
                return 'about';
            case (strcmp($command, 'exits') === 0):
                return 'exits';
            case (strcmp($command, 'attack') === 0):
            case (strcmp($command, 'kill') === 0):
                return 'attack';
            default:
                return null;
        }
    }

    /**
     * Removes all the articles from a given command string.
     *
     * @param $string
     * @return mixed
     */
    public static function removeArticles($string){
        $string = str_replace(' the ', ' ', $string);
        $string = str_replace(' a ', ' ', $string);
        $string = str_replace(' an ', ' ', $string);
        $string = str_replace(' on ', ' ', $string);

        return $string;
    }
}