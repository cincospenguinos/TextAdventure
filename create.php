<?php

// TODO: This page.

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="Script/lib/jquery-ui/jquery-ui.min.css" />
    <link type="text/css" rel="stylesheet" href="Script/lib/jquery-ui/jquery-ui.theme.min.css" />
    <link type="text/css" rel="stylesheet" href="View/Style/create_stylesheet.css"/>
    <script src="Script/lib/jquery.min.js"></script>
    <script src="Script/lib/jquery-ui/jquery-ui.min.js"></script>
    <script src="Script/Create/Model/Item.js"></script>
    <script src="Script/Create/Model/Room.js"></script>
    <script src="Script/Create/Model/DungeonManager.js"></script>
    <script src="Script/Create/View/RoomView.js"></script>-
    <script src="Script/Create/Controller/CreationManager.js"></script>
    <script src="Script/Create/controller.js"></script>
    <title>Dungeon Creator</title>
</head>
<body>
    <div id="menuBar">
        <ul>
            <li><a id="newRoomButton">New Room</a></li>
            <li><a id="saveDungeonButton">Save Dungeon</a></li>
            <li><a id="loadDungeonButton">Load Dungeon</a></li>
            <li><a id="testDungeonButton">Test Dungeon</a></li>
        </ul>
    </div>
    <div id="workspace">
    </div>
</body>
</html>';