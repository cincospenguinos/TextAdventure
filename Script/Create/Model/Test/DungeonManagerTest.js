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

/**
 * When I add a room to a dungeon, I should be able to get that room back out.
 */
QUnit.test('DungeonManagerGetRoom', function(assert) {
    var manager = new DungeonManager();
    var room = new Room();
    room.roomName = 'room';
    manager.addRoom(room);
    room = manager.getRoom('room');

    assert.ok(room.roomName);
});

/**
 * When I remove a room from a dungeon, I expect it to no longer be there.
 */
QUnit.test('DungeonManagerRemoveRoom', function(assert) {
    var manager = new DungeonManager();
    var room = new Room();

    room.roomName = 'herp';

    manager.addRoom(room);
    assert.ok(manager.hasRoom(room.roomName));
    manager.removeRoom(room.roomName);
    assert.notOk(manager.hasRoom(room.roomName));
});

QUnit.test('DungeonManagerChangeRoomName', function(assert) {
    var manager = new DungeonManager();
    var room = new Room();

    room.roomName = 'herp';

    manager.addRoom(room);
    assert.ok(manager.hasRoom(room.roomName));
    assert.ok(manager.getRoom('herp'));

    manager.changeRoomName(room.roomName, 'derp');
    assert.ok(manager.hasRoom('derp'));
    assert.notOk(manager.hasRoom('herp'));
    assert.ok(manager.getRoom('derp'));
});

