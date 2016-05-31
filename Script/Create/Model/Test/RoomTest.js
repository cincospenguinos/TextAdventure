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