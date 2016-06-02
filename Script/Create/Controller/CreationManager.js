/**
 * Created by tsvetok on 5/30/16.
 */

class CreationManager{
    constructor(){
        this.dungeonManager = new DungeonManager();
        this.namesManager = {};
        this.roomNameCounter = 0;
    }

    changeRoomName(parentRoomElement){
        // TODO: This
        console.log('Changed the room name.');
    }

    /**
     *
     * @param parentElement
     */
    createNewRoom(parentElement){
        // Handle all of the model stuff
        var roomName = 'room' + this.roomNameCounter;
        var room = new Room();
        room.name = roomName;
        this.namesManager[roomName] = roomName;
        this.dungeonManager.addRoom(room);

        // Add the widget to the DOM
        parentElement.append(`
            <div id="` + roomName + `" class="item roomWidget">
                <h3 id="` + roomName + `-name" class="editable roomName" contenteditable="true">` + roomName + `</h3>
            </div>
        `);

        // Add all the callbacks to the new element
        applyRoomWidgetCallbacks($('#' + roomName));

        this.roomNameCounter += 1;
    }

    getRoomName(roomID){
        return this.namesManager[roomID];
    }
}