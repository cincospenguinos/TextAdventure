# Linked Worlds

The repository for the Text Adventure we're building.

* [Taiga project](https://tree.taiga.io/project/cincospenguinos-rll_textadventure/backlog)
* [Slack Chat Room](https://rlltext.slack.com/messages/general/)

## Stuff that needs to be installed

* To run the tests that are included, phpunit needs to be installed, which requires php 5.6. We can get away with
5.5.9, but the tests can only be run off of php 5.6.
* memcached needs to be used instead of APC because APC is deprecated. So that needs to be installed.
    * Actually, we may not even need memcached. Using sessions works alright. We can consider it if the game ever gets super popular.
