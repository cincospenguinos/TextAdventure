/**
 * Created by tsvetok on 5/31/16.
 */
var plumb;
var creationManager;

const DIRECTION_STRINGS = [
    'NORTH',
    'NORTH EAST',
    'EAST',
    'SOUTH EAST',
    'SOUTH',
    'SOUTH WEST',
    'WEST',
    'NORTH WEST',
    'UP',
    'DOWN'
];

/**
 * Applies all of the jsPlumbing stuff given that the element passed is a
 * @param element
 */
function applyRoomPlumbing(element){
    // Exits or on the top right and bottom left
    var exitOptions = {
        isSource: true,
        isTarget: false,
        paintStyle: {width: '5px', height: '5px', fillStyle: '#000000'},
        style: {border: 'solid white 1px'}
    };
    var entranceOptions = {
        isSource: false,
        isTarget: true
    };

    // TODO: How to hook up the rooms selected in the model upon connecting two rooms together?
    var generateConnectionSelector = function(connection){
        var str = '<select id="">';

        for(var i = 0; i < DIRECTION_STRINGS.length; i++){
            str += '<option>' + DIRECTION_STRINGS[i] + '</option>'
        }

        return str + '</select>';
    };

    var exitConfigurations = {
        anchors: ['Right'],
        maxConnections: 10,
        connectorOverlays: [
        [ "PlainArrow", { width:10, length:30, location:1, id:"arrow" } ],
        [ "Label", { label:generateConnectionSelector, id:"label", cssClass: "roomConnectionSelector" } ],],
        connectorStyle: { lineWidth: 1, strokeStyle:"#FFFFFF" },
        cssClass: 'endpointNode'
    };

    // TODO: When connecting two nodes, how do two nodes have the ability to have two connections to each other?
    // TODO: Hide connection label until mouse moves over it

    var entranceConfigurations = {
        anchors: ['Left'],
        maxConnections: 10,
        cssClass: 'endpointNode'
    };

    plumb.addEndpoint(element, exitConfigurations, exitOptions);
    //plumb.addEndpoint(element, exitConfigurations, exitOptions);
    plumb.addEndpoint(element, entranceConfigurations, entranceOptions);
}

/**
 * Applies all the various callbacks pertinent to room widgets to the element provided.
 *
 * @param element
 */
function applyRoomWidgetCallbacks(element) {
    element.draggable({
        cancel: '.editable'
    });
    element.bind('drag', function(){
        plumb.repaintEverything();
    });
    element.dblclick(function(){
        toggleRoomWidget(element, true);
    });

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

    plumb.repaintEverything();
}

$(document).ready(function(){
    creationManager = new CreationManager();

    $('#newRoomButton').click(function(){
        creationManager.createNewRoom($('#workspace'));
    });

    jsPlumb.ready(function(){
        plumb = jsPlumb.getInstance();
        plumb.setContainer($('#workspace'));

        // TODO: All of the jsPlumb stuff. All of it.
    });
});