<?php

/**
 * User short summary.
 *
 * User description.
 *
 * @version 1.0
 * @author Jelena
 */
class User
{
	var $userID;
	var $username;
	var $name;
	var $last_name;
	var $email;
	var $password_hash;
	var $user_type;
	var $user_level;

    function __construct($args)
    {
        $this->userID = $args["userID"];
        $this->username = $args["username"];
        $this->name= $args["name"];
        $this->last_name= $args["last_name"];
        $this->email = $args["email"];
        $this->password_hash = $args["password"];
        $this->user_type = $args["user_type"];
        $this->user_level = $args["user_level"];
    }

    /*
    *	Fetch all users from database of type USER or MODERATOR;
    *	Implement after,active user status and delete automaticaly when user was not active for some period
    *	NOT TESTED
    */
    public static function fetchAllUsers()
    {
    	$database = Database::getInstance()->getConnection();
    	$sql = "SELECT * FROM users ORDER BY last_name,name";
        
        $result = $database->query($sql);

        if(!$result){
            return false;
        }

        $array=$result->fetch_all(MYSQLI_ASSOC);

        return $array;
    }
    
    /*
    *	Fetch all users from database filter by user_typed
    *	NOT TESTED
    */
    public static function fetchAllUsersByUserLevel($user_level)
    {
    	$database = Database::getInstance()->getConnection();
    	$sql = "SELECT * FROM users WHERE user_level='$user_level' ORDER BY last_name,name";
        
        $result = $database->query($sql);
        if(!$result){
            return false;
        }

        $array=$result->fetch_all(MYSQLI_ASSOC);

        return $array;
    }
    
    /*
    *	Change user_type, move up or move down user_level
    *	NOT TESTED
    */
    public static function changeUserType($userID,$user_type,$user_level)
    {
    	$database = Database::getInstance()->getConnection();
    	
    	$sql = "UPDATE users SET user_type='$user_type',user_level='$user_level' WHERE userID='$user_id'";
        
        $query_result = $database->query($sql);
        if ($query_result === TRUE) {
            return true;
        }
        return false;
    }
    
    /**
     * Writes the new user's data to the database
     *
     * @param name
     * @param $last_name
     * @param $user_name
     * @param $password_hash
     * @param $email
     * @return bool
     */
    public static function writeNewUserToDatabase($name,$last_name,$user_name, $email,$password_hash)
    {
        $database = Database::getInstance()->getConnection();
        // write new users data into database
        $sql = "INSERT INTO users (name,last_name,username, password, email)
                    VALUES ('$name','$last_name','$user_name', '$password_hash', '$email')";
        $query_result = mysqli_query($database, $sql);
        print_r($query_result);
        $count =  mysqli_num_rows($query_result);
        if ($query_result === TRUE) {
            return true;
        }
        return false;
    }

    /**
     * Writes the new user's data to the database
     *
     * @param name
     * @param $last_name
     * @param $user_name
     * @param $user_password_hash
     * @param $email
     * @return bool
     */
    public static function updateUserDataInDatabase($user_id,$name,$last_name,$user_name,$email,$password_hash)
    {
        $database = Database::getInstance()->getConnection();
        // write new users data into database

        $sql = "UPDATE users SET name='$name',last_name='$last_name',username='$user_name',email='$email',password='$password_hash' WHERE userID='$user_id'";
        //$sql = "INSERT INTO users (name,last_name,username, password, email)
        //            VALUES ('$name','$last_name','$user_name', '$password_hash', '$email')";
        //$query_result = mysqli_query($database, $sql);
        $query_result = $database->query($sql);
        if ($query_result === TRUE) {
            return true;
        }
        return false;
    }

    public static function getUserById($user_id)
    {
        $dbConnection = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM users where userID ='$user_id'";

        $result = mysqli_query($dbConnection,$sql);
        if(mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_assoc($result);
            
            $user = new User($row);
            return $user;
        }

        return NULL;
    }


    public static function getUserDataByUsername($username)
    {
        $dbConnection = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM users where username ='$username'";

        $result = mysqli_query($dbConnection,$sql);
        if(mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_assoc($result);
            
            $user = new User($row);
            return $user;
        }
        //// This is in the PHP file and sends a Javascript alert to the client
        //$message = "not returned user";
        //echo "<script type='text/javascript'>alert('$message');</script>";

        return NULL;
    }

    public static function userDataByUsernameExist($username)
    {
        return (self::getUserDataByUsername($username) ? true : false);
    }

    public static function getUserDataByEmail($email)
    {
        $dbConnection = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM users where email ='$email'";

        $result = mysqli_query($dbConnection,$sql);
        if(mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_assoc($result);
            $user = new User($row);
            return $user;
        }
        return NULL;
    }

    public static function userDataByEmailExist($email)
    {
        return (self::getUserDataByEmail($email) ? true : false);
    }
    
    /*
     * Delete user 	NOT TESTED
     * @param user_id
     * @return bool
     */
    public static function deleteUser($userID)
    {
    	$database = Database::getInstance()->getConnection();
    	
    	$sql = "DELETE FROM users WHERE userID='$userID'";
    	
        $query_result = $database->query($sql);
        if ($query_result === TRUE) {
            return true;
        }
        return false;
    }

    public static function updateUserLevel($userID,$userLevel)
    {
        $database = Database::getInstance()->getConnection();
        $sql = "UPDATE users SET user_level='$userLevel' WHERE userID='$userID'";

        $query_result = $database->query($sql);
        if ($query_result === TRUE) {
            return true;
        }
        return false;
    }

   
}

