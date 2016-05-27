<?php
/**
 * An item that can be interacted with by a player in a room.
 *
 * User: Andre LaFleur
 * Date: 5/13/16
 * Time: 3:10 PM
 */

namespace LinkedWorldsCore;


class Item
{
    /*
     * $aliases is a list of other names (case insensitive) that this Item can be referred to by. Example: Player
     * wants to take the Key of Gondor. An alias of Key of Gondor is "key," so if the player enters the command
     * "take key" then the parser will know that the player is referring to the key of Gondor.
     */
    private $itemName, $description, $aliases;

    public function __construct($_itemName, $_description)
    {
        $this->itemName = $_itemName;
        $this->description = $_description;
        $this->aliases = [];
    }

    /**
     * Creates an identical copy of the item passed in.
     *
     * @param $item
     * @return Item
     */
    public function copy(){
        $newItem = new Item($this->itemName, $this->description);
        $newItem->aliases = $this->aliases;
        return $newItem;
    }

    /**
     * Returns true if the alias passed exists in the collection of aliases for this item.
     *
     * @param $alias
     * @return bool
     */
    public function hasAlias($alias){
        return isset($this->aliases[strtolower($alias)]);
    }

    /**
     * Adds the alias passed
     *
     * @param $alias
     */
    public function addAlias($alias){
        $this->aliases[strtolower($alias)] = 1;
    }

    /**
     * Removes the alias matching the name provided, given that it exists.
     *
     * @param $alias
     */
    public function removeAlias($alias){
        unset($this->aliases[strtolower($alias)]);
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function getItemName()
    {
        return $this->itemName;
    }

    public function setItemName($itemName)
    {
        $this->itemName = $itemName;
    }
}