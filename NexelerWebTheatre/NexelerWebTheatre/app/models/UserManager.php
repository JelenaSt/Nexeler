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

        $result = self::validateAndGetUser($user_name, $user_password);
        if(!$result)
            return false;

        // successfully logged in
        self::setSuccessfulLoginIntoSession(
            $result->userID, $result->name, $result->user_type, $result->user_level);
        return true;
    }

    private static function validateAndGetUser($user_name, $user_password)
    {
   
        $result = User::getUserDataByUsername($user_name);

        if (!$result) {
            Session::set('warrning_message','User with this user name does not exist!');
            return false;
        }
        
        if (!password_verify($user_password, $result->password_hash)) {
            Session::set('warrning_message','Wrong password. Please try again!');
            return false;
        }

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
    public static function setSuccessfulLoginIntoSession($user_id, $name, $user_type, $user_level)
    {
        Session::init();
        // remove old and regenerate session ID.
        // It's important to regenerate session on sensitive actions,
        // and to avoid fixated session.
        // e.g. when a user logs in
        session_regenerate_id(true);
        $_SESSION = array();
        Session::set('user_id', $user_id);
        Session::set('name', $name);
        Session::set('user_type', $user_type);
        Session::set('user_level', $user_level);
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