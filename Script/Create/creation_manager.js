/**
 * Created by tsvetok on 5/30/16.
 */

// TODO: All of the javascript. All of it. Model, controller, etc.

$(document).ready(function(){
    var roomWidgets = $('.roomWidget');
    roomWidgets.tabs();
    roomWidgets.draggable();
    roomWidgets.resizable({
        alsoResize: '.roomDescription'
    });
    $('.tooltip').tooltip();
});