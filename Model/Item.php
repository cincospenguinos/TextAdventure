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
    private $itemName, $description; // TODO: Figure out item name stuff
    // TODO: Provide aliases? Basically there is the item name, but also key, master key, etc.

    public function __construct($_itemName, $_description)
    {
        $this->itemName = $_itemName;
        $this->description = $_description;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getItemName()
    {
        return $this->itemName;
    }

    /**
     * @param mixed $itemName
     */
    public function setItemName($itemName)
    {
        $this->itemName = $itemName;
    }

    /**
     * Creates an identical copy of the item passed in.
     *
     * @param $item
     * @return Item
     */
    public static function copy($item){
        $newItem = new Item($item->getItemName(), $item->getDescription());
        return $newItem;
    }
}