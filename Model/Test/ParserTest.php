<?php

/**
 * Created by PhpStorm.
 * User: tsvetok
 * Date: 5/28/16
 * Time: 9:30 PM
 */
include_once '../Parser.php';

class ParserTest extends PHPUnit_Framework_TestCase
{

    /**
     * When I remove articles, I expect the other words in the string to be retained.
     */
    public function testParserRemoveArticles1(){
        $string = 'squeeze the balls';
        $result = Parser::removeArticles($string);

        $this->assertTrue(strcmp($result, 'squeeze balls') === 0);
    }

    /**
     * When I remove articles, I expect the other words in the string to be retained.
     */
    public function testParserRemoveArticles2(){
        $string = 'fart on face';
        $result = Parser::removeArticles($string);

        $this->assertTrue(strcmp($result, 'fart face') === 0);
    }

    public function testParserRemoveArticles3(){
        $string = 'slap mother';
        $result = Parser::removeArticles($string);

        $this->assertTrue(strcmp($result, 'slap mother') === 0);
    }

    /**
     * Arch command from parser matches the look command.
     */
    public function testArchCommandLook(){
        $string = 'look';
        $result = Parser::getArchCommand($string);
        $this->assertTrue(strcmp($result, 'look') === 0);

        $string = 'look at item';
        $result = Parser::getArchCommand($string);
        $this->assertTrue(strcmp($result, 'look') === 0);

        $string = 'outlook on life';
        $result = Parser::getArchCommand($string);
        $this->assertTrue(is_null($result));
    }

    /**
     * Arch command from parser matches take command from both "take" and "get".
     */
    public function testArchCommandTake(){
        $string = 'take item';
        $otherString = 'get item';
        $s = 'Take';
        $p = 'Take it';
        $result = Parser::getArchCommand($string);
        $otherResult = Parser::getArchCommand($otherString);
        $r = Parser::getArchCommand($s);
        $q = Parser::getArchCommand($p);

        $this->assertTrue(strcmp($result, 'take') === 0);
        $this->assertTrue(strcmp($otherResult, 'take') === 0);
        $this->assertTrue(strcmp($r, 'take') === 0);
        $this->assertTrue(strcmp($q, 'take') === 0);
    }

    /**
     * Arch command from parser matches the go command from any of the various directions.
     */
    public function testArchCommandGo(){
        $possibleDirections = ['go north', 'go south', 'go southeast', 'southwest', 'sw', 'se',
        'nw', 'northwest', 'northeast', 'ne', 'go northeast', 'up', 'u', 'down', 'd'];

        foreach($possibleDirections as $direction){
            $result = Parser::getArchCommand($direction);
            $this->assertTrue(strcmp($result, 'go') === 0);
        }
    }

    public function testArchCommandDrop(){
        $string = 'drop item';
        $otherString = 'Drop it';
        $result = Parser::getArchCommand($string);
        $otherResult = Parser::getArchCommand($otherString);

        $this->assertTrue(strcmp($result, 'drop') === 0);
        $this->assertTrue(strcmp($otherResult, 'drop') === 0);
    }

    public function testArchCommandHelp(){
        $string = 'help';
        $result = Parser::getArchCommand($string);

        $this->assertTrue(strcmp($result, 'help') === 0);
    }

    public function testArchCommandAbout(){
        $string = 'about item';
        $result = Parser::getArchCommand($string);

        $this->assertTrue(strcmp($result, 'about') === 0);
    }

    public function testArchCommandInventory(){
        $string = 'Inv';
        $otherString = 'Inventory';
        $q = 'inventory';

        $result = Parser::getArchCommand($string);
        $otherResult = Parser::getArchCommand($otherString);
        $p = Parser::getArchCommand($q);

        $this->assertTrue(strcmp($result, 'inventory') === 0);
        $this->assertTrue(strcmp($otherResult, 'inventory') === 0);
        $this->assertTrue(strcmp($p, 'inventory') === 0);
    }

}
