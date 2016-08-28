<?php

/**
 * UserManager short summary.
 *
 * UserManager description.
 *
 * @version 1.0
 * @author Jelena
 */
class UserManager
{

    public static function login($user_name, $user_password, $set_remember_me_cookie = null)
    {
        if (empty($user_name) OR empty($user_password)) {
            Session::set('warrning_message','You must fill all input fields');
            return false;
        }

        //// checks if user exists
        //$result = self::validateAndGetUser($user_name, $user_password);
        //// check if that user exists. We don't give back a cause in the feedback to avoid giving an attacker details.
        //if (!$result) {
        //    return false;
        //}

        $result = User::getUserDataByUsername($user_name);
        
        if (!password_verify($user_password, $result->password_hash)) {
            Session::set('warrning_message','Wrong password.please try again');
           

            $message = "Userpass : " . $user_password . PHP_EOL . "Hash: " . $result->password_hash;
            echo "<script type='text/javascript'>alert('$message');</script>";

            return false;
        }
        // successfully logged in
        self::setSuccessfulLoginIntoSession(
            $result->userID, $result->username, $result->email, $result->user_type
        );
        return true;
    }

    private static function validateAndGetUser($user_name, $user_password)
    {
   
        $result = User::getUserDataByUsername($user_name,$user_password);

        // check if that user exists. We don't give back a cause in the feedback to avoid giving an attacker details.
        // brute force attack mitigation: reset failed login counter because of found user
        if (!$result) {
          
            return false;
        }
        
        print_r($result);

        return $result;
    }

    /**
     * The real login process: The user's data is written into the session.
     * Cheesy name, maybe rename. Also maybe refactoring this, using an array.
     *
     * @param $user_id
     * @param $user_name
     * @param $user_email
     * @param $user_account_type
     */
    public static function setSuccessfulLoginIntoSession($user_id, $user_name, $user_email, $user_account_type)
    {
        Session::init();
        // remove old and regenerate session ID.
        // It's important to regenerate session on sensitive actions,
        // and to avoid fixated session.
        // e.g. when a user logs in
        session_regenerate_id(true);
        $_SESSION = array();
        Session::set('user_id', $user_id);
        Session::set('username', $user_name);
        //Session::set('user_email', $user_email);
        Session::set('user_type', $user_account_type);
        //Session::set('user_provider_type', 'DEFAULT');
        // get and set avatars
        
        // finally, set user as logged-in
        Session::set('logged_in', true);
        // update session id in database
        // Session::updateSessionId($user_id, session_id());
        
    }

    public static function logout()
    {
        Session::destroy();

    }

}