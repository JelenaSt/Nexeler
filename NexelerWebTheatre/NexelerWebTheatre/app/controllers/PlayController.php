<?php

class PlayController extends Controller
{
  /*
   * render plays page
   */
  public function playspage()
  {
      $this->View->render('pages/play_details');
      exit();
  }
  
  public function createnewplay()
  {
  }
  
  public function updateplay()
  {
  }
  
  public function deleteplay($args)
  {
  }
  
  
}
?>
