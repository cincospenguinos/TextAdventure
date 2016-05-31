/**
 * Object representing a room that is shown on screen.
 */
class RoomView {

    constructor(roomName){
        this.roomName = roomName;
    }

    get name(){
        return this.roomName;
    }

    set name(roomName){
        $('#' + this.roomName).prop('id', roomName);
        this.roomName = roomName;
    }

    toHTML(){
        return `<div class="roomWidget" id="` + this.roomName + `">
        <h3 class="editable" id="` + this.roomName + `-name" contenteditable="true" title="Click here to change the room name">` + this.roomName + `</h3>
        <ul>
                <li><a href="#` + this.roomName + `-description">Description</a></li>
                <li><a href="#` + this.roomName + `-items">Items</a></li>
                <li><a href="#roomMonsters">Monsters</a></li>
                <li><a href="#otherOptions">Other Options</a></li>
        </ul>
        <div class="roomTabs">
            <div id="` + this.roomName + `-description" contenteditable="true" class="editable">Edit the description here.</div>
            <div id="` + this.roomName + `-items">
                <div class= "itemButton" id="itemButton` + this.roomName + `" title="Add an item to this room">+</div>
            </div>
            <div id="roomMonsters"></div>
            <div id="otherOptions">
                <label title="Select this to make this room be the starting room."><input type="checkbox" class="roomStartingRoomCheckbox"/>Starting room</label>
            </div>
        </div>
    </div>`;
    }
}