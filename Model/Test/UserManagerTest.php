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

}
