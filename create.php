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
    <script src="Script/Create/CreationManager.js"></script>
    <script src="Script/Create/View/RoomView.js"></script>
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
    <div id="workspace"></div>
</body>
</html>';

/* The room widget. Holy cats it's big.
 * <div class="roomWidget" id="` + id + `">
        <h3 class="editable" contenteditable="true">Edit the room name here</h3>
        <ul>
                <li><a href="#roomDescription">Description</a></li>
                <li><a href="#roomItems">Items</a></li>
                <li><a href="#roomMonsters">Monsters</a></li>
                <li><a href="#otherOptions">Other Options</a></li>
        </ul>
        <div class="roomTabs">
            <div id="roomDescription" contenteditable="true" class="editable">Edit the description here.</div>
            <div id="roomItems">
                <div class="itemButton" title="Add an item to this room">+</div>
            </div>
            <div id="roomMonsters"></div>
            <div id="otherOptions">
                <label title="Select this to make this room be the starting room."><input type="checkbox" class="roomStartingRoomCheckbox"/>Starting room</label>
            </div>
        </div>
    </div>
 */