<?php

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="Script/lib/jquery-ui/jquery-ui.min.css" />
    <link type="text/css" rel="stylesheet" href="Script/lib/jquery-ui/jquery-ui.theme.min.css" />
    <link type="text/css" rel="stylesheet" href="View/Style/create_stylesheet.css"/>
    <script src="Script/lib/jquery.min.js"></script>
    <script src="Script/lib/jquery-ui/jquery-ui.min.js"></script>
    <script src="Script/Create/creation_manager.js"></script>
    <!--TODO: All of the javascript to make this page awesome.-->
    <title>Create</title>
</head>
<body>
    <div class="roomWidget">
        <div class="roomName">
            <input type="text" placeholder="room name" class="roomNameInput"/>
        </div>
        <div>
            <ul>
                <li><a href="#roomDescriptionTab">Description</a></li>
                <li><a href="#roomItemsTab">Items</a></li>
                <li><a href="#roomMonstersTab">Monsters</a></li>
            </ul>
            <div id="roomDescriptionTab">
                <textarea class="roomDescription" placeholder="Description of room goes here"></textarea>
            </div>
            <div id="roomItemsTab">This is the second one.</div>
            <div id="roomMonstersTab">This is the third and last one.</div>
        </div>
    </div>
</body>
</html>';