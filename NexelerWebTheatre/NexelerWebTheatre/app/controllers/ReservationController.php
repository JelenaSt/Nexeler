<?php 

class ReservationController extends Controller{

  public function getAllUserReservations(){
    $user_id = Session::get('user_id');
    $reservations = Registration::getAllRegistrations($user_id);
    //$this->View
  } 
  
  public function deleteReservation(){
  
    $reservationID = Request::post('reservationId');
    $user_id = Session::get('user_id');
    
    Registration::deleteRegistration($reservationID);
  }
  
  
  public function addReservation(){
  
    $eventID = Request::post('event_id');
    $user_id = Session::get('user_id');
    $num_of_cards = Request::post('num_of_cards');
    
    $result = Registration::addRegistration($user_id,$eventID,$num_of_cards);
  }
  
}
?>