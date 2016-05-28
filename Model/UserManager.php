<?php

/**
 * Class that contains all of the various methods that manage users. Handles all of the memcaching and database lookup
 * information necessary for Users.
 *
 * TODO: Create a series of test cases for this class. This one needs to be tested to death.
 *
 * User: tsvetok
 * Date: 5/27/16
 * Time: 12:55 PM
 */
class UserManager
{


    public static function isUserLoggedIn($username){
        // TODO: This
    }

    /**
     * Creates a new user and stores that user into the database. Returns an array containing the username, password
     * and salt of the user in that order, or null if an error occurred.
     *
     * @param $dbConnection
     * @return array
     */
    public static function createNewUser($dbConnection){
        $username = self::generateRandomUsernameOrPassword();

        while(self::userExists($username, $dbConnection))
            $username = self::generateRandomUsernameOrPassword();

        $password = self::generateRandomUsernameOrPassword();
        $hashword = password_hash($password, PASSWORD_BCRYPT);
        $salt = substr($hashword, 7, 22);

        try{
            $statement = $dbConnection->prepare("INSERT INTO Users VALUES(:username, :hashword, :salt, NOW())");
            $statement->bindValue(':username', $username);
            $statement->bindValue(':hashword', $hashword);
            $statement->bindValue(':salt', $salt);
            $statement->execute();

            $affectedRows = $statement->rowCount();

            return [$username, $password, $salt];
        } catch(PDOException $ex){
            error_log('PDO Exception occurred!');
            error_log($ex->errorInfo);
            return null;
        }
    }

    /**
     * Creates a new account given the old username, new username, and new password for a given user. Returns
     * null if there was an error, or a boolean indicating whether the insertion was successful or not.
     *
     * @param $oldUsername
     * @param $newUsername
     * @param $newPassword
     * @param $dbConnection
     * @return bool|null
     */
    public static function createNewAccount($oldUsername, $newUsername, $newPassword, $dbConnection){
        if(!self::userExists($oldUsername, $dbConnection))
            return false;

        $hashword = password_hash($newPassword, PASSWORD_BCRYPT);
        $salt = substr($hashword, 7, 22);

        try {
            $statement = $dbConnection->prepare("UPDATE Users SET username=:newUsername, hashword=:hashword, salt=:salt
                                            WHERE username=:oldUsername");
            $statement->bindParam(':newUsername', $newUsername);
            $statement->bindParam(':hashword', $hashword);
            $statement->bindParam(':salt', $salt);
            $statement->bindParam(':oldUsername', $oldUsername);
            $statement->execute();

            return self::userExists($newUsername, $dbConnection);
        } catch(PDOException $ex){
            error_log('PDO Exception occurred!');
            error_log($ex->errorInfo);
            return null;
        }
    }

    /**
     * Checks to see if the user matching the username passed exists. Returns null if an error occurred,
     * or a boolean value indicating whether or not the user exists.
     *
     * @param $username
     * @param $dbConnection
     * @return null|bool
     */
    public static function userExists($username, $dbConnection){
        try {
            $statement = $dbConnection->prepare("SELECT * FROM Users WHERE username=:username");
            $statement->bindValue(':username', $username);
            $statement->execute();
            $result = $statement->fetch();

            if($result == false)
                return false;

            return true;
        } catch(PDOException $ex) {
            error_log('PDO Exception occurred!');
            error_log($ex->errorInfo);

            return null;
        }
    }

    /**
     * Generates a random username or password.
     *
     * @param int $length
     * @return string
     */
    private static function generateRandomUsernameOrPassword($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}