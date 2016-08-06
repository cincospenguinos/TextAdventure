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
    // TODO: Turn over to factory design pattern?
    protected $itemName, $lookAtDescription, $lookDescription, $aliases, $canEquip, $canTake, $whenEquipped;

    /**
     * Item constructor.
     * @param $_itemName - name of this item
     * @param $_lookAtDescription - description of the item when the player looks at it
     * @param null $_lookDescription - description of the item when it appears in a room
     * @param bool $_canEquip - whether or not this item is equippable
     * @param bool $_canTake - whether or not the player can pick up this item (AKA it is an environmental item)
     */
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

    /**
     * Returns true if this item has a modifier when equipped for the ability passed.
     *
     * @param $ability
     * @return bool
     */
    public function hasEquipModifier($ability){
        return isset($this->whenEquipped[$ability]);
    }

    /**
     * Returns the modifier when equipping this item.
     *
     * @param $ability
     * @return mixed
     */
    public function getEquipModifier($ability){
        return $this->whenEquipped[$ability];
    }

    /**
     * Remove the modifier associated with the ability passed.
     * @param $ability
     */
    public function removeEquipModifier($ability) {
        unset($this->whenEquipped[$ability]);
    }

    /**
     * Sets whether or not this item can be equipped.
     * @param $equip
     */
    public function setEquippable($equip){
        $this->canEquip = $equip;
    }

    /**
     * @return mixed
     */
    public function getLookAtDescription(){
        return $this->lookAtDescription;
    }

    public function setLookAtDescription($lookAtDescription){
        $this->lookAtDescription = $lookAtDescription;
    }

    public function getName()
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