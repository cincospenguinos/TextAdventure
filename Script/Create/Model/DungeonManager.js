/**
 * DungeonManager.js
 *
 * Manages dungeon creation on the client. Holds the current dungeon and all that shiz.
 *
 * https://code.jquery.com/qunit/qunit-1.23.1.js
 */

class DungeonManager {

    constructor () {
        this.rooms = [];
    }

    addRoom(room){
        // TODO: type checking?
        this.rooms[room.name()] = room;
    }

    removeRoom(roomName){
        this.rooms[roomName] = null;
    }
}
