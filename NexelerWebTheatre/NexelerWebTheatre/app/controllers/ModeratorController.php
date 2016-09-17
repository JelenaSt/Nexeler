<?php 
class ModeratorController extends Controller
{
  /*
   * render moderator page
   * Preview moderator user profile
   */
	public function moderatorpage()
	{
        $eventID = Session::get('eventID');
        if(!$eventID){
            $eventID = Session::set('eventID',null);
            $type = "all";
            $reservations = Reservation::fetchAllReservations();
        }else{
            $type =$eventID;
            $reservations = Reservation::getReservationsForEvent($eventID);
        }
        
        
        $this->View->render('usermanagement/moderator_profile',array('reservations' => $reservations,'type'=>$type));
	  exit();
	}

    public function filter()
	{
        
        $eventID = Request::post('eventID');
        Session::set('eventID',$eventID );
       // $reservations = Reservation::getReservationsForEvent($eventID);
        
       // $this->View->render('usermanagement/moderator_profile',array('reservations' => $reservations,));
        //echo 'TEST' .  $eventID . 'session ' . Session::get('eventID');
        //exit();
	}

}