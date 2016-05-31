/**
 * Room.js
 *
 * Represents a single room in the dungeon creator.
 */

const DIRECTION = {
    NORTH : 0,
    NORTH_EAST : 1,
    EAST : 2,
    SOUTH_EAST : 3,
    SOUTH : 4,
    SOUTH_WEST : 5,
    WEST : 6,
    NORTH_WEST : 7,
    UP : 8,
    DOWN : 9
};

class Room {

    constructor() {
        this.roomName = null;
        this.itemsInRoom = [];
        this.monsters = [];
        this.exits = [];
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

    addExit(direction, room){
        this.exits[direction] = room;
    }

    hasExit(direction){
        return (direction in this.exits);
    }

    removeExit(direction){
        delete this.exits[direction];
    }
}