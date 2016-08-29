<?php 
class AdminController extends Controller
{
  /*
   * render admin page
   */
  public function adminpage()
  {
      Session::
      $users= User::fetchAllUsersByUserLevel(USER_LEVEL);
      $moderators= User::fetchAllUsersByUserLevel(MODERATOR_LEVEL);

      $this->View->render('usermanagement/admin_profile',array('users' => $users, 'moderators' => $moderators));
  }
  
  /*
   * delete user
   * @param userID
   */
  public function deleteuser($userID)
  {
  
  }
  
  public function promoteUser($userID)
  {
    
  }
  
  public function downgradeModerator($userID)
  {
    
  }
}
