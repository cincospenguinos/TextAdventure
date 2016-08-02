# Balancing Tests

To help facilitating RPG design, I made this collection of tests to test balancing players and monsters.

## How the design works

There are four attributes representing one of the traditional four elements:

* Strength (Fire)
* Constitution (Earth)
* Dexterity (Air)
* Intelligence (Water)

Each of those attributes helps contribute to at least one other stat. They are

* Physical damage (strength)
* Physical to-hit (dexterity)
* Hit Points (strength & constitution)
* Spell to-hit (constitution)
* Evasiveness (dexterity and intelligence)
* Spell damage (intelligence)

How each of them is calculated depends on whether the person with the stats is a player or a monster. Ideally, a level
one player should be able to defeat two level two monsters. Balancing still needs to be tinkered with and setup just
right, but this series of tests helps make it quite easy to properly balance.

At level one, the player is given the opportunity to take upon him/herself one of four templates (or classes, whatever)
according to what attribute is strongest:

* Fighter (strength)
* Cleric (constitution)
* Rogue (dexterity)
* Sorcerer (intelligence)

## How monsters should be designed

I'm thinking monsters should be designed according to their kill/death ratio is against the player. If a monster has
about twenty stat points, but a level one player is able to kill about 4 of them until dying, then that monster is not
a level one monster. Having it be built this way makes sure that the monsters are always compared to players (the way
that they should be used) rather than having an independent function dictate whether or not a monster can defeat a player
very easily.

That would require building some pretty serious stuff to pull off, but it could make the design of a dungeon a lot easier
for the player, as he/she would be told "this monster is a level X monster; having Y of them makes this a level X dungeon."