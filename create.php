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
    <script src="Script/Create/creation_manager.js"></script>
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
    <div class="roomWidget">
        <h3 class="editable" contenteditable="true">Edit the room name here</h3>
        <ul>
                <li><a href="#roomDescriptionTab">Description</a></li>
                <li><a href="#roomItemsTab">Items</a></li>
                <li><a href="#roomMonstersTab">Monsters</a></li>
                <li><a href="#otherOptionsTab">Other Options</a></li>
        </ul>
        <div class="roomTabs">
            <div id="roomDescriptionTab" contenteditable="true" class="editable">Edit the description here.</div>
            <div id="roomItemsTab">
                <div class="roomItems"></div>
            </div>
            <div id="roomMonstersTab">
                <div class="roomMonsters"></div>
            </div>
            <div id="otherOptionsTab">
                <label title="Select this to make this room be the starting room."><input type="checkbox" class="roomStartingRoomCheckbox"/>Starting room</label>
            </div>
        </div>
    </div>
</body>
</html>';