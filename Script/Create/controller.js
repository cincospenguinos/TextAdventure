/**
 * Created by tsvetok on 5/31/16.
 */
$(document).ready(function(){
    var creationManager = new CreationManager();

    $('#newRoomButton').click(function(){
        creationManager.createNewRoom();
    });
});