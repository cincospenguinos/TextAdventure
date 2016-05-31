/**
 * Test the DungeonManager class.
 */

QUnit.test('DungeonManagerTestConstructor', function(){
    var manager = new DungeonManager();
    expect(0);
});

/**
 * When I add a room to a dungeon, I expect an error to be thrown if there is no name on the
 * room, otherwise the room should be there.
 */
QUnit.test('DungeonManagerTestAddRoom', function(assert){
    var manager = new DungeonManager();
    var room = new Room();

    try {
        // Cannot add a room with a null name to a dungeon!
        manager.addRoom();
        assert.ok(false);
    } catch(err){
        assert.ok(true);
    }

    room.roomName = 'herp';

    manager.addRoom(room);
    assert.ok(manager.hasRoom(room.roomName));
});