<?php
/**
 * A single room that is intended to be a part of a dungeon.
 *
 * User: Andre LaFleur
 * Date: 5/13/16
 * Time: 3:10 PM
 */

namespace LinkedWorldsCore;

require_once 'Direction.php';
require_once 'Item.php';
require_once 'Monster.php';

class Room
{
    private $roomName, $description, $itemsInRoom, $monstersInRoom, $guid;

    public function __construct($_roomName, $_description)
    {
        $this->roomName = $_roomName;
        $this->description = $_description;
        $this->itemsInRoom = [];
        $this->monstersInRoom = [];

        $this->guid = $this->generateGUID();
    }

    /**
     * Returns the description of the room.
     *
     * @return string
     * @throws \TypeError
     */
    public function look(){
        // TODO: Move this out to the controller. It will clean the code up quite a bit
        $description = $this->description;

        foreach($this->itemsInRoom as $item) {
            if(null !== $item->getLookDescription()){
                $description .= " " . $item->getLookDescription();
            } else {
                $description .= " You see a " . strtolower($item->getName()) . " here."; // TODO: Better grammar
            }
        }

        foreach($this->monstersInRoom as $monster) {
            if($monster->isDead())
                $description .= " There is the corpse of a " . strtolower($monster->getName()) . " here.";
            else
                $description .= " There is a " . strtolower($monster->getName()) . " here.";
        }

        return $description;
    }

    /**
     * Returns the description of the item or the monster matching the name provided.
     *
     * @param $name
     * @return string or null
     */
    public function lookAt($name){
        // TODO: Move this out to the controller. It will clean the code up quite a bit
        $name = strtolower($name);

        if(isset($this->itemsInRoom[$name]))
            return $this->itemsInRoom[$name]->getLookAtDescription();

        // Don't forget to check for item aliases!
        foreach($this->itemsInRoom as $item)
            if($item->hasAlias($name))
                return $item->getLookAtDescription();

        if(isset($this->monstersInRoom[$name]))
            return $this->monstersInRoom[$name]->getDescription();

        // Don't forget to check for item aliases!
        foreach($this->monstersInRoom as $monster)
            if($monster->hasAlias($name))
                return $monster->getDescription();

        return null;
    }

    /**
     * Adds the item passed into the array.
     *
     * TODO: Should an error be thrown if an item with that name already exists? How should we manage copies?
     * TODO: Should we throw an error here if $item is not an Item?
     * @param $item
     */
    public function addItem($item) {
        $this->itemsInRoom[strtolower($item->getName())] = $item;
    }

    /**
     * Returns true if the item matching the name provided is inside of this room.
     *
     * @param $itemName
     * @return bool
     */
    public function hasItem($itemName) {
        $itemName = strtolower($itemName);
        if(isset($this->itemsInRoom[strtolower($itemName)]))
            return true;

        foreach($this->itemsInRoom as $item){
            if($item->hasAlias($itemName))
                return true;
        }

        return false;
    }

    /**
     * Removes the item from the collection of items in this room. Returns that item if it exists
     * or null if it does not exist. Seeks first to match the name of the item and if that fails
     * checks all the aliases of all the items. Returns false if the item cannot be taken.
     *
     * @param $itemName
     * @return Item|null|false
     */
    public function removeItem($itemName) {
        $itemName = strtolower($itemName);

        if(isset($this->itemsInRoom[$itemName])) {
            if(!$this->itemsInRoom[$itemName]->isRemovable())
                return false;

            $itemToBeRemoved = $this->itemsInRoom[$itemName];
            unset($this->itemsInRoom[$itemName]);
            return $itemToBeRemoved;
        } else {
            foreach($this->itemsInRoom as $item) {
                if (!$item->isRemovable())
                    return false;
                if ($item->hasAlias($itemName)) {
                    unset($this->itemsInRoom[strtolower($item->getName())]);
                    return $item;
                }
            }
        }

        return null;
    }

    /**
     * Adds the monster passed to the collection.
     *
     * @param $monster
     */
    public function addMonster($monster){
        $this->monstersInRoom[strtolower($monster->getName())] = $monster;
    }

    /**
     * Returns true if the monster with the name passed exists in this room, or if it matches an alias.
     *
     * @param $monsterName
     * @return bool
     */
    public function hasMonster($monsterName){
        $monsterName = strtolower($monsterName);
        if(isset($this->monstersInRoom[$monsterName]))
            return true;

        foreach($this->monstersInRoom as $item){
            if($item->hasAlias($monsterName))
                return true;
        }

        return false;
    }

    /**
     * Returns the monster matching the name or alias provided, if it is in this room. Otherwise, returns null.
     *
     * @param $monsterName
     * @return mixed|null
     */
    public function getMonster($monsterName){
        $monsterName = strtolower($monsterName);
        if(isset($this->monstersInRoom[$monsterName]))
            return $this->monstersInRoom[$monsterName];

        foreach($this->monstersInRoom as $monster){
            if($monster->hasAlias($monsterName))
                return $monster;
        }

        return null;
    }

    /**
     * Removes the monster matching the name passed.
     *
     * @param $monsterName
     */
    public function removeMonster($monsterName){
        unset($this->monstersInRoom[strtolower($monsterName)]);
    }

    /**
     * If the monster matching the name provided is dead, takes the entire inventory and drops it on the ground.
     * Otherwise, this method does nothing.
     *
     * @param $monsterName
     */
    public function monsterKilled($monsterName) {
        $monster = $this->getMonster($monsterName);

        if(isset($monster) && $monster->isDead()){
            foreach($monster->getItemList() as $item){
                $this->addItem($monster->removeItem($item));
            }
        }
    }

    /**
     * Returns the entire collection of hostile monsters who are not dead.
     *
     * @return array
     */
    public function allHostileMonsters(){
        $monsters = [];

        foreach($this->monstersInRoom as $monster){
            if($monster->isHostile() && !$monster->isDead())
                array_push($monsters, $monster);
        }

        return $monsters;
    }

    /**
     * Returns the description of this room.
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Sets the description to this room
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Returns the name of this room.
     *
     * @return string
     */
    public function getRoomName()
    {
        return $this->roomName;
    }

    /**
     * Set the room name of this room to the name provided.
     *
     * @param string $roomName
     */
    public function setRoomName($roomName)
    {
        $this->roomName = $roomName;
    }

    public function getGUID(){
        return $this->guid;
    }

    /**
     * Generates a GUID for this room.
     *
     * @return string
     */
    private function generateGUID(){
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = chr(123)// "{"
            .substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12)
            .chr(125);// "}"
        return $uuid;
    }
}