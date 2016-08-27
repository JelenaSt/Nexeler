<?php


class Session
{
    var $username;     //Username given on sign-up
    var $userid;       //Random value generated on current login
    var $userlevel;    //The level to which the user pertains
    var $time;         //Time user was last active (page loaded)
    var $logged_in;    //True if user is logged in, false otherwise
    var $userinfo = array();  //The array holding all user info
    var $url;          //The page url current being viewed
    var $referrer;     //Last recorded site page viewed

    public function __construct()
    {
        $this->time = time();
        $this->startSession();
    }

     /**

    * startSession - Performs all the actions necessary to 
    * initialize this session object. Tries to determine if the
    * the user has logged in already, and sets the variables 
    * accordingly. Also takes advantage of this page load to
    * update the active visitors tables.
    */
   function startSession(){ 
      session_start();   //Tell PHP to start the session
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

    * checkLogin - Checks if the user has already previously
    * logged in, and a session with the user has already been
    * established. Also checks to see if user has been remembered.
    * If so, the database is queried to make sure of the user's 
    * authenticity. Returns true if the user has logged in.
    */
   function checkLogin(){
       
       /* Username and userid have been set and not guest */

       if(isset($_SESSION['username']) && isset($_SESSION['userid']) &&
          $_SESSION['username'] != GUEST_NAME){
           
           /* Confirm that username and userid are valid */
           //if($database->confirmUserID($_SESSION['username'], $_SESSION['userid']) != 0){
           //   /* Variables are incorrect, user not logged in */
           //   unset($_SESSION['username']);
           //   unset($_SESSION['userid']);
           //   return false;
           //}
           /* User is logged in, set class variables */

           $this->userinfo  = Database::getInstance()->getUserInfo($_SESSION['username']);
           $this->username  = $this->userinfo['username'];
           $this->userid    = $this->userinfo['userid'];
           $this->userlevel = $this->userinfo['userlevel'];
           return true;
       }
       /* User not logged in */
       else{
           return false;
       }
   }
   
}

$session = new Session();

?>