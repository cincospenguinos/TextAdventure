<?php

// TODO: Switch over from simple jquery to jsquery UI.
echo "<!DOCTYPE HTML>
<html>
    <head>
        <meta charset='UTF-8'/>
        <title>Not all who wander are lost</title>
        <link rel='stylesheet' type='text/css' href='View/Style/global_stylesheet.css'/>
        <link rel='stylesheet' type='text/css' href='View/Style/play_stylesheet.css'/>
        <script type='text/javascript' src='Script/lib/jquery.min.js'></script>
        <script type='text/javascript' src='Script/Play/cmdmanager.js'></script>
    </head>
    <body>
        <noscript>
            <p>Javascript is necessary to play this game. Please enable javascript on this page.</p>
        </noscript>
        <div id='content_container'>
            <div id='response_container'>
            </div>
            <div id='command_prompt'>
                <span>&gt;</span>
                <input type='text' id='player_command' autofocus/>
            </div>
        </div>
    </body>
</html>";