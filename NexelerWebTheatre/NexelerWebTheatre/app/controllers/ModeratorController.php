<?php 
class ModeratorController extends Controller
{
  /*
   * render moderator page
   * Preview moderator user profile
   */
	public function moderatorpage()
	{
        $GLOBALS['filter'] = true;
         //$message = Session::get('filter') ?  Session::get('filter') : 'prazno';
         //echo "<script type='text/javascript'>alert('$message');</script>";

        //if(!isset($filter)){
        if(!$GLOBALS['filter']){
          $type = "no filter";
        

          $reservations = Reservation::fetchAllReservations();
          $this->View->render('usermanagement/moderator_profile',array('reservations' => $reservations));
        	 
          exit();
        }
        else{
            $playName =  Session::get('playName');
            Session::set('playName',null);
            $name = Session::get('nameUser');
            Session::set('nameUser',null);
            $userId = Session::get('userId');
            Session::set('userId',null);
            $datum = Session::get('datum');
            Session::set('datum',null);

            $reservations = Reservation::filterReservations($playName,$datum,$userId,$name);
            $this->View->render('usermanagement/moderator_profile',array('reservations' => $reservations));
        }

        $GLOBALS['filter'] = false;

        // echo "<script type='text/javascript'>alert('$message');</script>";
	}

    public function filter()
	{

        $GLOBALS['filter'] = true;

        $playName = Request::post('playName');
        $name = Request::post('name_user');
        $userId = Request::post('userId');
        $datum = Request::post('datum');

        Session::set('playName',$playName);
        Session::set('nameUser',$name);
        Session::set('userId',$userId);
        Session::set('datum',$datum);

       //$reservations = Reservation::getReservationsForEvent($eventID);
       //$this->View->render('usermanagement/moderator_profile',array('reservations' => $reservations,));
       //echo 'TEST' .  $eventID . 'session ' . Session::get('eventID');
       //exit();
      // echo  Session::get('filter');

      $type = "filter";
      $reservations = Reservation::fetchAllReservations();
      $this->View->render('usermanagement/moderator_profile',array('reservations' => $reservations,'type'=>$type));

	}

}