/**
 * DungeonManager.js
 *
 * Manages dungeon creation on the client. Holds the current dungeon and all that shiz.
 *
 * https://code.jquery.com/qunit/qunit-1.23.1.js
 */

class DungeonManager {

    constructor () {
        this.rooms = {};
    }

    addRoom(room) {
        if(room.roomName == null)
            throw 'Room name cannot be null when adding the room!';

        this.rooms[room.roomName] = room;
    }

    hasRoom(roomName){
        return (roomName in this.rooms);
    }

    getRoom(roomName){
        return this.rooms[roomName];;
    }

    removeRoom(roomName){
        delete this.rooms[roomName];
    }

    changeRoomName(oldName, newName){
        var room = this.rooms[oldName];
        room.roomName = newName;
        this.rooms[newName] = this.rooms[oldName];
        delete this.rooms[oldName];
    }
}
