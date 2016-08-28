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

    public static function getUserById($user_id)
    {
        $database = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM users where userID =:user_id";
    }


    public static function getUserDataByUsername($username)
    {
     
        $dbConnection = Database::getInstance()->getConnection();
      
        $sql = "SELECT * FROM users where username ='".strtolower($username)."'";

        $result = mysqli_query($dbConnection,$sql);
        if(mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_assoc($result);
            
            $user = new User($row);
            
            return $user;
        }

        echo 'no user';
        // This is in the PHP file and sends a Javascript alert to the client
        $message = "not returned user";
        echo "<script type='text/javascript'>alert('$message');</script>";

        return false;
    }

   
}

