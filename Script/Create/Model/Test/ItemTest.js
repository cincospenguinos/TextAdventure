/**
 * Uses QUnit to test the Item class.
 */

QUnit.test('ItemTestConstructor', function (){
    var item = new Item();
    expect(0);
});

/**
 * When I add an alias to an item, I expect it to be there and I expect it to
 * be case insensitive.
 */
QUnit.test('ItemTestAddAlias', function(assert) {
    var item = new Item();
    item.itemName = 'Item';
    item.itemDescription = 'A simple item.';
    item.addAlias('thing');
    assert.ok(item.hasAlias('thing'));
    assert.ok(item.hasAlias('Thing'));
    assert.ok(item.hasAlias('tHinG'));
});

/**
 * When an alias doesn't exist in an item object, I should be told that the alias isn't there.
 */
QUnit.test('ItemTestAliasDoesNotExist', function(assert){
    var item = new Item();
    assert.notOk(item.hasAlias('thing'));
    item.addAlias('item');
    assert.notOk(item.hasAlias('it em'));
});