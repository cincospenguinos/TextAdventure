/**
 * Created by tsvetok on 5/30/16.
 */

// TODO: All of the javascript. All of it. Model, controller, etc.

var number = 0;

function createNewRoom(){
    var id= 'room' + number;
    number += 1;

    var chunk = `<div class="roomWidget" id="` + id + `">
        <h3 class="editable" contenteditable="true">Edit the room name here</h3>
        <ul>
                <li><a href="#roomDescription">Description</a></li>
                <li><a href="#roomItems">Items</a></li>
                <li><a href="#roomMonsters">Monsters</a></li>
                <li><a href="#otherOptions">Other Options</a></li>
        </ul>
        <div class="roomTabs">
            <div id="roomDescription" contenteditable="true" class="editable">Edit the description here.</div>
            <div id="roomItems">
                <div class="itemButton" title="Add an item to this room">+</div>
            </div>
            <div id="roomMonsters"></div>
            <div id="otherOptions">
                <label title="Select this to make this room be the starting room."><input type="checkbox" class="roomStartingRoomCheckbox"/>Starting room</label>
            </div>
        </div>
    </div>`;

    $('#workspace').append(chunk);

    var newRoomWidget = $('#' + id);
    newRoomWidget.tabs({
        active: 0
    });

    newRoomWidget.resizable({
        alsoResize: '.roomDescription .roomItems'
    });

    newRoomWidget.draggable({
        cancel: '.editable'
    });
}

$(document).ready(function(){
    $('#newRoomButton').click(createNewRoom);
});