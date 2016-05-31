/**
 * Test the Room class in javascript.
 */

QUnit.test('RoomTestConstructor', function(){
    var room = new Room();
    expect(0);
});

/**
 * When I add an item to the room, I expect it to be there.
 */
QUnit.test('RoomTestAddItem', function(assert){
    var room = new Room();
    var item = new Item();
    item.itemName = 'Item';
    item.description = 'A simple item.';
    room.addItem(item);
    assert.ok(room.hasItem(item.itemName));
});

/**
 * When I remove an item from a room, I expect it to be gone.
 */
QUnit.test('RoomTestRemoveItem', function(assert){
    var room = new Room();
    var item = new Item();
    item.itemName = 'Item';
    item.description = 'A simple item.';
    room.addItem(item);
    assert.ok(room.hasItem(item.itemName));

    room.removeItem(item.itemName);
    assert.notOk(room.hasItem(item.itemName));
});

/**
 * When I add an exit to a room, I expect it to be there.
 */
QUnit.test('RoomTestAddExit', function(assert){
    var room = new Room();
    var otherRoom = new Room();

    room.addExit(DIRECTION.NORTH_EAST, otherRoom);
    assert.ok(room.hasExit(DIRECTION.NORTH_EAST));
    assert.notOk(room.hasExit(DIRECTION.SOUTH));
});

/**
 * When I remove an exit from a room, I expect it to no longer be there.
 */
QUnit.test('RoomTestRemoveExit', function(assert){
    var room = new Room();
    var otherRoom = new Room();

    room.addExit(DIRECTION.NORTH_EAST, otherRoom);
    assert.ok(room.hasExit(DIRECTION.NORTH_EAST));
    room.removeExit(DIRECTION.NORTH_EAST);
    assert.notOk(room.hasExit(DIRECTION.NORTH_EAST));
});