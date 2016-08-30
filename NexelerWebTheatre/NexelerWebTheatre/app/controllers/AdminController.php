<?php 
class AdminController extends Controller
{
  /*
   * render admin page
   * Preview admin user profile, list all users by type
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
      $result = User::deleteUserByID($userID);
      
  }
  
  public function promoteUser($userID)
  {
     $result = User::setUserLevelByID($userID.$user_level);
     return result;
  }
  
  public function downgradeModerator($userID)
  {
      $result = User::setUserLevelByID($userID.$user_level);
      return result;
  }
}
