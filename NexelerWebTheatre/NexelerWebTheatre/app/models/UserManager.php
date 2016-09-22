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
            
            Session::setErrorFeedback('Morate popuniti sva zahtevana polja!');
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
            Session::setErrorFeedback('Korisnik sa zadatim korisni?kim imenom ne postoji!!');
            return false;
        }
        
        if (!password_verify($user_password, $result->password_hash)) {
           Session::setErrorFeedback('Pogrešno uneta šifra. Molimo Vas pokušajte ponovo!');
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
            Session::setErrorFeedback('Korisni?ko ime je ve? iskorisceno. Molimo odaberiti novo i pokušajte ponovo.');
            $return = false;
        }
        // check if email already exists
        if (User::userDataByEmailExist($email)) { 
            Session::setErrorFeedback("Email adresa je ve? u upotrebi. Molimo pokušajte ponovo.");
            $return = false;
        }
        // if Username or Email were false, return false
        if (!$return) return false;

        $return = User::writeNewUserToDatabase($name, $last_name, $user_name, $email, $password_hash);
        if (!$return){
            Session::setErrorFeedback("Slanje zahteva za registraciju je neuspešno. Molimo pokušajte kasnije.");
            return false;
        }
        
        Session::setInfoFeedback("Vaš profil je uspešno kreiran. Unesite vaše korisni?ko ime i šifru da se ulogujete na stranu!");
        return true; 
    }

    public static function updateUserData($user_id,$name, $last_name, $user_name, $email, $password, $password_repeat)
    {
        // stop registration flow if registrationInputValidation() returns false
        $validation_result = self::registrationInputValidation($name, $last_name, $user_name, $email, $password, $password_repeat);
        if (!$validation_result) {
            return false;
        }
        

        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        // make return a bool variable, so both errors can come up at once if needed
        
        $return = true;
        $user = User::getUserById($user_id);

        if($user->username !== $user_name){
            // check if new username already exists
            if (User::userDataByUsernameExist($user_name)) {
                Session::setErrorFeedback('Korisni?ko ime je ve? iskoriš?eno. Molimo odaberiti novo i pokušajte ponovo.');
                $return = false;
            }
        }
      
        if($user->email !== $email){
            // check if new email already exists
            if (User::userDataByEmailExist($email)) { 
                Session::setErrorFeedback("Email adresa je ve? u upotrebi. Molimo pokušajte ponovo.");
                $return = false;
            }
        }
        // if Username or Email were false, return false
        if (!$return) return false;

        $return = User::updateUserDataInDatabase($user_id,$name, $last_name, $user_name, $email, $password_hash);
        if (!$return){
            Session::setErrorFeedback("Trenutno nismo u mogucnosti da izvrsimo izmene. Molimo pokusajte kasnije.");
            return false;
        }
        
        Session::setInfoFeedback("Vas profil je uspesno izmenjen.");
        return true; 
    }

    /**
     * Validates the registration input
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
       
        // if username is too short (2), too long (64) or does not fit the pattern
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
     * @return bool
     */
    public static function validateUserEmail($user_email)
    {
       
       
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

    public static function checkUsernameAvailability($username){
        
        $user = User::getUserDataByUsername($username);

        if(!$user)
            return false;
        else return true;
    }


   
    

}