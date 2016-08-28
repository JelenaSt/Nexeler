<?php


class Session
{
    //var $username;     //Username given on sign-up
    //var $userid;       //Random value generated on current login
    //var $userlevel;    //The level to which the user pertains
    //var $time;         //Time user was last active (page loaded)
    //var $logged_in;    //True if user is logged in, false otherwise
    //var $userinfo = array();  //The array holding all user info
    //var $url;          //The page url current being viewed
    //var $referrer;     //Last recorded site page viewed

    public static function init()
    {

        if(session_id() == '')
        {
            session_start();
        }
      
    }

     /**

    * startSession - Performs all the actions necessary to 
    * initialize this session object. Tries to determine if the
    * the user has logged in already, and sets the variables 
    * accordingly. Also takes advantage of this page load to
    * update the active visitors tables.
    */
   public static function  startSession(){ 
       session_start();   
      /* Determine if user is logged in */

      $this->logged_in = $this->checkLogin();
      /**

       * Set guest value to users not logged in, and update
       * active guests table accordingly.
       */
      if(!$this->logged_in){
         $this->username =  GUEST_NAME;
         $this->userlevel = GUEST_LEVEL;
        
      }

      $_SESSION['username'] = $this->username;

      /* Set referrer page */
      if(isset($_SESSION['url'])){
         $this->referrer = $_SESSION['url'];
      }else{
         $this->referrer = "/";
      }
      /* Set current url */

      $this->url = $_SESSION['url'] = $_SERVER['PHP_SELF'];
   }

   /**
    * sets a specific value to a specific key of the session
    *
    * @param mixed $key key
    * @param mixed $value value
    */
   public static function set($key, $value)
   {
       $_SESSION[$key] = $value;
   }
   /**
    * gets/returns the value of a specific key of the session
    *
    * @param mixed $key Usually a string, right ?
    * @return mixed the key's value or nothing
    */
   public static function get($key)
   {
       if (isset($_SESSION[$key])) {
           $value = $_SESSION[$key];
           // filter the value for XSS vulnerabilities
           return $value;
       }
   }

  /*
    * checkLogin - Checks if the user has already previously
    * logged in, and a session with the user has already been
    * established. Also checks to see if user has been remembered.
    * If so, the database is queried to make sure of the user's 
    * authenticity. Returns true if the user has logged in.
    */
   //function checkLogin(){
       
   //    /* Username and userid have been set and not guest */

   //    if(isset($_SESSION['username']) && isset($_SESSION['userid']) &&
   //       $_SESSION['username'] != GUEST_NAME){
           
   //        /* Confirm that username and userid are valid */
   //        //if($database->confirmUserID($_SESSION['username'], $_SESSION['userid']) != 0){
   //        //   /* Variables are incorrect, user not logged in */
   //        //   unset($_SESSION['username']);
   //        //   unset($_SESSION['userid']);
   //        //   return false;
   //        //}
   //        /* User is logged in, set class variables */

   //        $this->userinfo  = Database::getInstance()->getUserInfo($_SESSION['username']);
   //        $this->username  = $this->userinfo['username'];
   //        $this->userid    = $this->userinfo['userid'];
   //        $this->userlevel = $this->userinfo['userlevel'];
   //        return true;
   //    }
   //    /* User not logged in */
   //    else{
   //        return false;
   //    }
   //}
   
   /**
    * deletes the session (= logs the user out)
    */
   public static function destroy()
   {
       session_destroy();
   }

   public static function userIsLoggedIn()
   {
       return (self::get('logged_in') ? true : false);
   }

   public static function getErrorFeedback(){
       $error_feedback = Session::get('error_feedback');
       Session::set('error_feedback', null);
       return $error_feedback;
   }

   public static function setErrorFeedback($errorFeedback){
        Session::set('error_feedback',$errorFeedback);
   }

   public static function errorFeedbackExists(){
       return (self::get('error_feedback') ? true : false);
   }

   public static function getInfoFeedback(){
       $infoFeedback = Session::get('info_feedback');
       Session::set('error_feedback', null);
       return $infoFeedback;
   }

   public static function setInfoFeedback($infoFeedback){
       Session::set('info_feedback',$infoFeedback);
   }

   public static function infoFeedbackExists(){
       return (self::get('info_feedback') ? true : false);
   }
}


?>