# The Wandering Gods

The repository for the Text Adventure we're building.

* [Taiga project](https://tree.taiga.io/project/cincospenguinos-rll_textadventure/backlog)
* [Slack Chat Room](https://rlltext.slack.com/messages/general/)

## Stuff that needs to be installed

* To run the tests that are included, phpunit needs to be installed, which requires php 5.6. We can get away with
5.5.9 in production, but the tests can only be run off of php 5.6.
* memcached needs to be used instead of APC because APC is deprecated. So that needs to be installed.
    * Actually, we may not even need memcached. Using sessions works alright. We can consider it if the game ever gets super popular.

## Notes from Play Testing

The following are some notes given to me from friends I showed the game to. They are organized into four categories: things that
need to be fixed, things that I should consider fixing, things that are good about the game that I need to preserver, and
notes that are a bit subjective and may need more exploring.

### Things to fix

* Can’t look at a lot of things
    * This could be due to there not being many things to look at, or more things need more descriptions.
* Questioning the authenticity of how or why some of the things are where they are
    * Stefano explained this to mean that some things in the tutorial felt out of place. Like a castle under a cabin doesn't seem reasonable.
* Spacing on the index page should be reworked. Have larger margins on each side.
* It is that it is too short, small, etc.

### Things to consider

* Help menu isn’t initially displayed, which can create confusion/frustration for new players who don’t understand the text-based adventure medium.
    * Maybe just display something right on the landing page that's hard coded giving a brief introduction and direct players to the help command if
    necessary.
* Both east and west go the front of house, which can lead to confusion
    * Makes me feel like it's kind of hand holding to not do this
* Looming feeling of railroading, not that linear gameplay is bad and the feeling isn’t totally there, but just be weary.
    * Make multiple paths through different rooms to the same endpoint
* Varying colors of the text could help break up the look of the game. (ie: all narration is white, room descriptions are yellow, enemy encounters are in red, etc)
    * This is actually a good idea. It's a break from the medium, but a good idea.


### Things to preserve

* Bolded text that states what room you’re in is a big help, although it (and its flavor text) does get a bit hard to find amongst the other text.
* When re-looking at the secret shrine room, the “corpse of the cultist” is a nice touch.
    * We should definitely implement a "loot the corpes" feature
* I didn't get lost at all because I felt it was described better

### Things to explore