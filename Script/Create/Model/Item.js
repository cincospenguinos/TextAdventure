/**
 * Created by tsvetok on 5/30/16.
 */

class Item {

    construct() {}

    get description(){
        return this.itemDescription;
    }

    set description(description){
        this.itemDescription = description;
    }

    get name() {
        return this.itemName;
    }

    set name(name) {
        this.itemName = name;
    }
}