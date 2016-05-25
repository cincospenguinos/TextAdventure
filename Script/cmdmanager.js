/**
 * cmdmanager.js
 *
 * Manages all of the client-side commands - obtaining them, sending and receiving them, etc.
 */

function getResponse(command){
    // TODO: Set this up the way it needs to
}

$(document).ready(function(){
    $(document).keydown(function(event){
        // If the enter key has been pressed, then grab the command, send it to the server, and report what the server said
        if(event.which == 13) {
            var command = $('#playerCommand').val();
            $('#playerCommand').val('');
            var response = getResponse(command);
        }
    });
});