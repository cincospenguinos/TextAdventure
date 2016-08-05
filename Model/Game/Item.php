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
    private $itemName, $lookAtDescription, $lookDescription, $aliases, $canEquip, $canTake, $whenEquipped;
    // $lookDescription is the description shown in the string that comes from the "look" command
    // $lookAtDescription is the description shown when the player looks at the item specifically"

    public function __construct($_itemName, $_lookAtDescription, $_lookDescription = null, $_canEquip = false, $_canTake = true)
    {
        $this->itemName = $_itemName;
        $this->lookAtDescription = $_lookAtDescription;
        $this->canEquip = $_canEquip;
        $this->canTake = $_canTake;
        $this->aliases = [];
        $this->whenEquipped = [];

        if(isset($_lookDescription))
            $this->lookDescription = $_lookDescription;
    }

    /**
     * Creates an identical copy of the item passed in.
     *
     * @param $item
     * @return Item
     */
    public function copy(){
        $newItem = new Item($this->itemName, $this->lookAtDescription);
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

    public function getLookAtDescription(){
        return $this->lookAtDescription;
    }

    public function setLookAtDescription($lookAtDescription){
        $this->lookAtDescription = $lookAtDescription;
    }

    public function getItemName()
    {
        return $this->itemName;
    }

    public function setItemName($itemName)
    {
        $this->itemName = $itemName;
    }

    public function getLookDescription(){
        return $this->lookDescription;
    }

    public function isRemovable(){
        return $this->canTake;
    }
}