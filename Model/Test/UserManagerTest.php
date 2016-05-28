<?php

/**
 * Created by PhpStorm.
 * User: tsvetok
 * Date: 5/28/16
 * Time: 11:11 AM
 */
include_once '../UserManager.php';
include_once '../../dbconfig.php';

class UserManagerTest extends PHPUnit_Framework_TestCase
{
    private $dbConnection;

    public function setUp(){
        $this->dbConnection = getDBConnection();
    }

    public function tearDown(){
        $statement = $this->dbConnection->prepare("DELETE FROM Users");
        $statement->execute();

        unset($dbConnection);
    }

    /**
     * If a user is thrown into the Users table, then I expect it to be there and UserManager::userExists()
     * to find it.
     */
    public function testUserExists(){
        $username = 'poop';
        $hashword = password_hash('balls', PASSWORD_BCRYPT);
        $salt = substr($hashword, 7, 22);

        $statement = $this->dbConnection->prepare("INSERT INTO Users VALUES(:username, :hashword, :salt, NOW())");
        $statement->bindParam(':username', $username);
        $statement->bindParam(':hashword', $hashword);
        $statement->bindParam(':salt', $salt);
        $statement->execute();

        $this->assertTrue(UserManager::userExists($username, $this->dbConnection));
    }

    /**
     * When I attempt to create a new user, I expect that user to be there.
     */
    public function testCreateNewUser(){
        $username = UserManager::createNewUser($this->dbConnection)[0];
        $statement = $this->dbConnection->prepare("SELECT * FROM Users WHERE username=:username");
        $statement->bindParam(':username', $username);
        $result = $statement->fetch();

        $this->assertTrue(isset($result));
        $this->assertTrue(UserManager::userExists($username, $this->dbConnection));
    }

    /**
     * When I create a new account out of an old guest user, I expect that account to be there.
     */
    public function testCreateNewAccount(){
        $newUsername = 'herp';

        $oldUsername = UserManager::createNewUser($this->dbConnection)[0];
        $isSuccessful = UserManager::createNewAccount($oldUsername, $newUsername, 'derp', $this->dbConnection);

        $this->assertTrue(isset($isSuccessful));

        $statement = $this->dbConnection->prepare("SELECT * FROM Users WHERE username=:username");
        $statement->bindParam(':username', $newUsername);
        $result = $statement->fetch();

        $this->assertTrue(isset($result));
    }

    /**
     * When a user is not logged in, then I should be told that the user isn't logged in.
     */
    public function testUserNotLoggedIn(){
        $this->assertFalse(UserManager::getLoggedInUser('SAJDFLDFSAJKLAFSD'));
    }
}
