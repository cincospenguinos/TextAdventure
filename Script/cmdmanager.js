/**
 * cmdmanager.js
 *
 * TODO: Username/password?
 *
 * Manages all of the client-side commands - obtaining them, sending and receiving them, etc.
 */
var API_ENDPOINT = 'Controller/main.php'; // TODO: Change this for releases, always
const ENTER_KEY = 13;

/**
 * Gets a response from the server and executes whatever functions are passed
 * given a success or failure from the server.
 *
 * @param commandData
 * @param onSuccess
 * @param onFailure
 */
function submitCommand(commandData, onSuccess, onFailure){
    $.ajax({
        type: 'POST',
        url: API_ENDPOINT,
        data: commandData,
        success: onSuccess,
        error: onFailure
    });
}

$(document).ready(function(){
    $(document).keydown(function(event){
        if(event.which === ENTER_KEY) {
            var command = $('#playerCommand').val();
            $('#playerCommand').val('');

            // TODO: Username/password?
            var data = {
                'command': command,
                'username': null,
                'password': null
            };

            submitCommand(data, function(response){
                response = $.parseJSON(response);
                $('#response').append("<p>" + response.response + "</p>");
            }, function(response){
                $('#response').append("<p>An error occurred.</p>");
            });
        }
    });

    $(document).click(function(){
        $('#playerCommand').select();
    });
});