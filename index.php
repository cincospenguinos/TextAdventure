<?php
/**
 * Created by PhpStorm.
 * User: Andre LaFleur
 * Date: 5/25/16
 * Time: 12:08 PM
 */
echo "
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset=\"UTF-8\"/>
        <link rel='stylesheet' type='text/css' href='View/Style/global_stylesheet.css'/>
        <script type='text/javascript' src='Script/lib/jquery.min.js'></script>
        <script type='text/javascript' src='Script/cmdmanager.js'></script>
    </head>
    <body>
        <noscript>
            <p>Javascript is necessary to play this game. Please enable javascript on this page.</p>
        </noscript>
        <div id='response'>

        </div>
        <div id='commandPrompt'>
            <span>&gt</span>
            <input type='text' id='playerCommand' autofocus/>
        </div>
    </body>
</html>";