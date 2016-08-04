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
    // TODO: Add another description variable for when an item appears in a room
    // TODO: Make item be unable to be picked up and stuff.

    /*
     * $aliases is a list of other names (case insensitive) that this Item can be referred to by. Example: Player
     * wants to take the Key of Gondor. An alias of Key of Gondor is "key," so if the player enters the command
     * "take key" then the parser will know that the player is referring to the key of Gondor.
     *
     * $whenEquipped is just a collection of attributes to modify when the item gets equipped.
     */
    private $itemName, $description, $aliases, $canEquip, $whenEquipped;

    public function __construct($_itemName, $_description, $_canEquip = false)
    {
        $this->itemName = $_itemName;
        $this->description = $_description;
        $this->canEquip = $_canEquip;
        $this->aliases = [];
        $this->whenEquipped = [];
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

    /**
     * Adds or changes the modifier provided for the ability provided that is applied when the player
     * equips the item.
     *
     * @param $ability
     * @param $amount
     */
    public function setEquipModifier($ability, $amount) {
        $this->whenEquipped[$ability] = $amount;
    }

    public function hasEquipModifier($ability){
        return isset($this->whenEquipped[$ability]);
    }

    public function getEquipModifier($ability){
        return $this->whenEquipped[$ability];
    }

    public function removeEquipModifier($ability) {
        unset($this->whenEquipped[$ability]);
    }

    public function setEquippable($equip){
        $this->canEquip = $equip;
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