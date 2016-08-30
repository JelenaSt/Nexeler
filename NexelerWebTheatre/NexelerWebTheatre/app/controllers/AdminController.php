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
      $result = User::deleteUser($userID);
      Redirect::to('admin/adminpage');
      
  }
  
  public function promote($userID)
  {

      if(User::updateUserLevel($userID,MODERATOR_LEVEL)){
          Session::put('info_feedback','user successfully promoted to moderator');
      }
      else
          Session::put('error_feedback','user is not promoted to moderator');
      Redirect::to('admin/adminpage');
  }
  
  public function downgrade($userID)
  {
      User::updateUserLevel($userID,USER_LEVEL);
      Redirect::to('admin/adminpage');
  }
}
