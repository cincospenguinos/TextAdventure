# Commands

The way commands work is quite straightforward:

1. The commands endpoint REST endpoint "command.php" manages all of the player commands. It uses the parser to figure
out what command it is, and then includes the file that matches that command.
2. The file that matches that command is located in "Controller/Commands/" directory. You can think of it as calling
a function, as there are certain conditions that are promised with a command file and certain results each command
file promises.
    * The command file expects there to be a $data array which will be converted into JSON and sent to the client
    * The command file expects there to be a $command variable, which contains the full command provided from the
    user.
    * The command file promises to fill the $data array with an appropriate response to the user's command.
    * The command file promises that it will execute the command given to it if within the parameters of that command.
3. After the command file executes, the $data array is expected to be full and is converted to JSON and sent to the
client.

Whenever creating a new command, the contract described above must apply to that command. Under no exceptions should
any of these be broken, most especially the information below concerning the help command.

## The Help Command

The help command is meant to be a dynamic one. As the commands change and are modified to properly fit the game, the
help command picks up information in each command file and displays it in readable text to the player. Thus it is
absolutely imperative that each command is named exactly what it does, and that each command contains a simple
comment that denotes what it actually does to the user. As an example, the about command contains the following
comment:

    /*
    *~ describes information about this game
    */
    
The line that will be shown to the user is the line in the comment that begins with a tilde character ('~'). Simply
include some line in your command file's comments somewhere that has this to ensure that the help command can properly
represent each of the different commands.