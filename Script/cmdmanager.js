/**
 * cmdmanager.js
 *
 * TODO: Username/password?
 *
 * Manages all of the client-side commands - obtaining them, sending and receiving them, etc.
 */
var API_ENDPOINT = 'Controller/main.php'; // TODO: Change this for releases, always
var username = null;
const ENTER_KEY = 13;

/**
 * Returns a random username of the length passed.
 *
 * @returns {string}
 */
function randomUsername(length)
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i = 0; i < length; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

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
    username = randomUsername(10);
    var data = {'command': 'look', 'username': username, 'password': null};

    submitCommand(data, function(response){
        response = $.parseJSON(response);
        $('#response').append("<p>" + response.response + "</p>");
    }, function(response){
        $('#response').append("<p>An error occurred.</p>");
    });

    $(document).keydown(function(event){
        if(event.which === ENTER_KEY) {
            var command = $('#playerCommand').val();
            $('#playerCommand').val('');

            var data = {
                'command': command,
                'username': username,
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