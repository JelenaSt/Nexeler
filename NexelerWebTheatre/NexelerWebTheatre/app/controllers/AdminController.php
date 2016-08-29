<?php 
class AdminController extends Controller
{
  /*
   * render admin page
   */
  public function adminpage()
  {
       $userid = Session::get('user_id');
      
       $admin = User::getUserById($userid);

      $users= User::fetchAllUsersByUserLevel(USER_LEVEL);
      $moderators= User::fetchAllUsersByUserLevel(MODERATOR_LEVEL);

      $this->View->render('usermanagement/admin_profile',array('admin' => $admin, 'users' => $users, 'moderators' => $moderators));
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
