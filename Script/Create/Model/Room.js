/**
 * Room.js
 *
 * Represents a single room in the dungeon creator.
 */

class Room {

    constructor() {
        this.roomName = null;
        this.itemsInRoom = [];
        this.monsters = [];
    }

    get name(){
        return this.roomName;
    }

    set name(name){
        this.roomName = name;
    }

    addItem(item){
        this.itemsInRoom[item.itemName.toLowerCase()] = item;
    }

    hasItem(itemName){
        return (itemName.toLowerCase() in this.itemsInRoom);
    }

    removeItem(itemName){
        delete this.itemsInRoom[itemName.toLowerCase()];
    }
}