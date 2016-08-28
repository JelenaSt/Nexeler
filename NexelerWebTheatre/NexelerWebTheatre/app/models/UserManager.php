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


    public static function registerNewUser($name, $last_name, $user_name, $email, $password, $password_repeat)
    {
        //// clean the input
        //$name = strip_tags(Request::post('user_name'));
        //$last_name = strip_tags(Request::post('last_name'));
        //$user_name = strip_tags(Request::post('user_name'));
        //$email = strip_tags(Request::post('email'));
        //$password = Request::post('password');
        //$password_repeat = Request::post('password_repeat');
        
        // stop registration flow if registrationInputValidation() returns false
        $validation_result = self::registrationInputValidation($name, $last_name, $user_name, $email, $password, $password_repeat);
        if (!$validation_result) {
            return false;
        }
       
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        // make return a bool variable, so both errors can come up at once if needed
       
        $return = true;
        // check if username already exists
        if (User::userDataByUsernameExist($user_name)) {
            Session::setErrorFeedback('Korisnicko ime je vec iskorisceno. Molimo odaberiti novo i pokusajte ponovo.');
            $return = false;
        }
        // check if email already exists
        if (User::userDataByEmailExist($email)) { 
            Session::setErrorFeedback("Email adresa je vec u upotrebi. Molimo pokusajte ponovo.");
            $return = false;
        }
        // if Username or Email were false, return false
        if (!$return) return false;

        $return = User::writeNewUserToDatabase($name, $last_name, $user_name, $email, $password_hash, $password_repeat);
        if (!$return){
            Session::setErrorFeedback("Slanje zahteva za registraciju je neuspesno. Molimo pokusajte kasnije.");
            return false;
        }
        
        Session::setInfoFeedback("Vas profil je uspesno kreiran. Unesite vase korisnicko ime i sifru da se ulogujete na stranu!");
        return true;
        ////// write user data to database
        ////if (!self::writeNewUserToDatabase($user_name, $user_password_hash, $user_email, time(), $user_activation_hash)) {
        ////    Session::add('feedback_negative', Text::get('FEEDBACK_ACCOUNT_CREATION_FAILED'));
        ////    return false; // no reason not to return false here
        ////}
        ////// get user_id of the user that has been created, to keep things clean we DON'T use lastInsertId() here
        ////$user_id = UserModel::getUserIdByUsername($user_name);
        ////if (!$user_id) {
        ////    Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
        ////    return false;
        ////}
       
    }




    /**
     * Validates the registration input
     *
     * @param $captcha
     * @param $user_name
     * @param $user_password_new
     * @param $user_password_repeat
     * @param $user_email
     * @param $user_email_repeat
     *
     * @return bool
     */
    public static function registrationInputValidation($name, $last_name, $user_name, $email, $password, $password_repeat)
    {
        $return = true;
        
        // if username, email and password are all correctly validated, but make sure they all run on first sumbit
        if (self::validateUserName($user_name) AND self::validateUserEmail($email) AND self::validateUserPassword($password, $password_repeat) AND $return) {
            return true;
        }
        // otherwise, return false
        return false;
    }
    /**
     * Validates the username
     *
     * @param $user_name
     * @return bool
     */
    public static function validateUserName($user_name)
    {
        if (empty($user_name)) {
            Session::setErrorFeedback("Polje: korisnicko ime je prazno. Molimo popunite sva zahtevana polja.");
            return false;
        }
        // if username is too short (2), too long (64) or does not fit the pattern (aZ09)
        if (!preg_match('/^[a-zA-Z0-9]{2,64}$/', $user_name)) {
            Session::setErrorFeedback("Korisnicko ime je krace od 2 slova ili sadrzi nedozvoljene karaktere.");
            return false;
        }
        return true;
    }
    /**
     * Validates the email
     *
     * @param $user_email
     * @param $user_email_repeat
     * @return bool
     */
    public static function validateUserEmail($user_email)
    {
        if (empty($user_email)) {
            Session::setErrorFeedback("Polje: email je prazno. Molimo popunite sva zahtevana polja.");
            return false;
        }
       
        // validate the email with PHP's internal filter
        if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            Session::setErrorFeedback("Uneta email adresa ne zadovoljava standarde email adrese.");
            return false;
        }
        return true;
    }
    /**
     * Validates the password
     *
     * @param $user_password_new
     * @param $user_password_repeat
     * @return bool
     */
    public static function validateUserPassword($password, $password_repeat)
    {
        if (empty($password) OR empty($password_repeat)) {
            Session::setErrorFeedback("Polje: sifra ili ponovljena sifra je prazno. Molimo popunite sva zahtevana polja.");
            return false;
        }
        if ($password !== $password_repeat) {
            Session::setErrorFeedback("Vrednost polja za sifru se ne poklapaju. Popunite ispravno polja i pokusajte ponovo!");
            return false;
        }
        if (strlen($password) < 6) {
            Session::setErrorFeedback("Uneta duzina sifre je prekratka. Molimo unesite vise od 6 karaktera!");
            return false;
        }
        return true;
    }
    

}