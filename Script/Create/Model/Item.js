/**
 * Created by tsvetok on 5/30/16.
 */

class Item {

    constructor() {
        this.aliases = {};
    }

    /**
     * Returns the item description if it exists, or false if it does not.
     *
     * @returns {*}
     */
    get description(){

        if(this.itemDescription !== null)
            return this.itemDescription;
        else
            return false;
    }

    set description(description){
        this.itemDescription = description;
    }

    /**
     * Returns the item name if it exists, or false if it does not.
     *
     * @returns {*}
     */
    get name() {
        if(this.itemName !== null)
            return this.itemName;
        else
            return false;
    }

    set name(name) {
        this.itemName = name;
    }

    addAlias(alias){
        this.aliases[alias.toLowerCase()] = alias.toLowerCase();
    }

    hasAlias(alias){
        return (alias.toLowerCase() in this.aliases);
    }

    removeAlias(alias){
        delete this.aliases[alias.toLowerCase()];
    }
}