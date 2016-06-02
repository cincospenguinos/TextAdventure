/**
 * Created by tsvetok on 5/31/16.
 */
var plumb;
var creationManager;

/**
 * Applies all the various callbacks pertinent to room widgets to the element provided.
 *
 * @param element
 */
function applyRoomWidgetCallbacks(element) {
    element.draggable({
        cancel: '.editable'
    });
    element.dblclick(function(){
        toggleRoomWidget(element, true);
    });

    // TODO; For some reason this gets called multiple times, even when the room name hasn't changed.
    $('.roomName').blur(function(){
        creationManager.changeRoomName(element);
    });
}

/**
 * Toggles a room widget from a rectangle to an ellipse, and back.
 *
 * @param roomWidget
 * @param toEllipse
 */
function toggleRoomWidget(roomWidget, toEllipse){
    var offset = roomWidget.offset();
    var roomId = roomWidget.attr('id');
    var roomName = creationManager.getRoomName(roomId);

    if(toEllipse){
        roomWidget.removeClass('roomWidget');
        roomWidget.addClass('roomEllipse');

        roomWidget.width('100px');
        roomWidget.height('100px');
    } else {
        roomWidget.removeClass('roomEllipse');
        roomWidget.addClass('roomWidget');

        roomWidget.width('250px');
        roomWidget.height('100px');
    }

    roomWidget.offset({ top: offset.top, left: offset.left });

    roomWidget.dblclick(function(){
        toggleRoomWidget(roomWidget, !toEllipse);
    });
}

$(document).ready(function(){
    creationManager = new CreationManager();

    $('#newRoomButton').click(function(){
        creationManager.createNewRoom($('#workspace'));
    });

    jsPlumb.ready(function(){
        plumb = jsPlumb.getInstance();

        // TODO: All of the jsPlumb stuff. All of it.
    });
});