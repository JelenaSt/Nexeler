<?php 
class ModeratorController extends Controller
{
  /*
   * render moderator page
   * Preview moderator user profile
   */
	public function moderatorpage()
	{
      $this->View->render('usermanagement/moderator_profile');
	  exit();
	}

}