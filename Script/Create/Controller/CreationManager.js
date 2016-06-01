/**
 * Created by tsvetok on 5/30/16.
 */

class CreationManager{
    constructor(){
        this.dungeonManager = new DungeonManager();
        this.namesManager = {};
        this.roomNameCounter = 0;
    }

    /**
     * Creates a new room, attaches the proper parts to it, and throws it on the page.
     */
    createNewRoom(){
        // Create the variables and store the necessary parts
        var room = new Room();
        room.roomName = 'Room' + this.roomNameCounter;
        var roomView = new RoomView(room.roomName);
        this.namesManager[room.roomName] = room.roomName;

        // Make it all show up on the page
        $('#workspace').append(roomView.toHTML());

        // Manage the jquery UI stuff
        var newRoomNode = $('#' + room.roomName);
        newRoomNode.draggable({
            cancel: '.editable'
        });
        newRoomNode.tabs();
        newRoomNode.resizable();

        // Callback for when the room name changes
        $('#' + room.roomName + '-name').blur(function(){
            var oldName = names[room.roomName];
            var newName = $('#' + room.roomName + '-name').text();
            manager.changeRoomName(oldName, newName);
            names[oldName] = names[newName];
            delete names[oldName];

            console.log(manager.getRoom(newName));
        });

        // Callback for when user adds a connection to a room
        $('#' + room.roomName).dblclick(function(){

        });
        // Add it to the manager
        this.dungeonManager.addRoom(room);
        this.roomNameCounter += 1;
    }
}