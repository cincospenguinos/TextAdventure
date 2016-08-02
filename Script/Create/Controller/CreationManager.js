/**
 * Created by tsvetok on 5/30/16.
 */

class CreationManager{
    constructor(){
        this.dungeonManager = new DungeonManager();
        this.roomNameCounter = 0;
    }

    /**
     * Triggered when the user changes the name of a roomWidget. Changes the name of the room in the model.
     *
     * @param parentRoomElement --> a room widget
     */
    changeRoomName(parentRoomElement){
        var roomId = parentRoomElement.attr('id');
        var roomNameElement = $('#' + roomId + '-name');
        var oldName = parentRoomElement.attr('roomname');
        var newName = roomNameElement.text();

        // If we got empty text as a new name, then just revert it back to the old name
        if(!/\S+/.test(newName)){
            roomNameElement.text(oldName);
            return;
        }

        if(oldName === newName.trim())
            return;

        newName = newName.trim();

        this.dungeonManager.changeRoomName(oldName, newName);
        parentRoomElement.attr('roomname', newName);
        roomNameElement.text(newName);
    }

    /**
     * Creates a new room widget within the parent element provided.
     *
     * @param parentElement
     */
    createNewRoom(parentElement){
        // Handle all of the model stuff
        var roomName = 'room' + this.roomNameCounter;
        var room = new Room();
        room.name = roomName;
        this.dungeonManager.addRoom(room);

        // Add the widget to the DOM
        parentElement.append(`
            <div id="` + roomName + `" class="item roomWidget" roomname="` + roomName + `">
                <h3 id="` + roomName + `-name" class="editable roomName" contenteditable="true">` + roomName + `</h3>
            </div>
        `);

        // Add all the callbacks to the new element
        applyRoomWidgetCallbacks($('#' + roomName));
        applyRoomPlumbing($('#' + roomName));

        this.roomNameCounter += 1;
    }
}