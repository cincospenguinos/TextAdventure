/**
 * Created by tsvetok on 5/30/16.
 */

// TODO: Add Items to rooms
// TODO: Add Directions to rooms
var manager = new DungeonManager();
var names = []; // This is used to help manage all of the names of the various rooms
var counter = 0;

function createNewRoom(){
    // Create a new room object
    var room = new Room();
    room.roomName = 'Room' + counter;

    // Create room view
    var roomView = new RoomView(room.roomName);

    // Add the room's name to the collection of names
    names[room.roomName] = room.roomName;

    // Create the HTML associated and throw it down on the page.
    $('#workspace').append(roomView.toHTML());

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
        var room = manager.getRoom(newName);

        console.log(room.roomName);
    });


    // Add it to the manager
    manager.addRoom(room);
    counter += 1;
}

$(document).ready(function(){
    $('#newRoomButton').click(createNewRoom);
});