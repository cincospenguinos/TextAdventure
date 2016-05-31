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

    public addItem(item){
        this.itemsInRoom[item.name()] = item;
    }

    public removeItem(itemName){
        this.itemsInRoom[itemName] = null;
    }

    public setRoomName(roomName){
        this.roomName = roomName;
    }

}