/**
 * Created by tsvetok on 5/30/16.
 */

$(document).ready(function(){
    var roomWidgets = $('.roomWidget');
    roomWidgets.tabs();
    roomWidgets.draggable();
    roomWidgets.resizable({
        alsoResize: '.roomDescription'
    });
});