<?php 

class ReservationController extends Controller{


  
  public function delete(){
  
    $reservationID = Request::get('reservationID');

    
    Reservation::deleteReservation($reservationID);
    Redirect::to('profile/profilepage');
     
  }
  
  
  public function addReservation(){
  
    $eventID = Request::post('event_id');
    $user_id = Session::get('user_id');
    $num_of_cards = Request::post('num_of_cards');
    
    $result = Reservation::addNewReservation($user_id,$eventID,$num_of_cards);

    Redirect::to('pages/events');
  }
  
}
?>
