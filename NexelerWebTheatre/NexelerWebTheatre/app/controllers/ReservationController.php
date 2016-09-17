<?php 

class ReservationController extends Controller{


  
  public function delete(){
  
    $reservationID = Request::post('reservationID');

    
    $result = Reservation::deleteReservation($reservationID);

    if(!$result){
       echo 'error';
    }

    echo 'Uspesno obrisana rezervacija broj' . $reservationID;
  }
  
  
  public function addReservation(){
  
    $eventID = Request::post('event_id');
    
    $user_id = Session::get('user_id');
    $num_of_cards = Request::post('num_of_cards');
    
    $result = Reservation::addNewReservation($user_id,$eventID,$num_of_cards);

    if(!$result){
        return false;
    }
    
    //$reservation = Reservation::getReservationById($result);
    echo "Broj vaše rezervacije " . $result;
  }
  
}
?>
