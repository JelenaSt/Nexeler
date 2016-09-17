<?php
  class Reservation
  {
    var $reservationID;
    var $user_id;
    var $event_id;
    var $card_num;
    
    public function __construct($args){
      $this->reservationID = $args['reservationID'];
      $this->user_id = $args['user_id'];
      $this->event_id = $args['event_id'];
      $this->card_num = $args['card_num'];
    }
    
    public static function getReservationsForUser($user_id){
    
      $date_time = new DateTime();
      $date = $date_time->format('Y-m-d');

      $database = Database::getInstance()->getConnection();
      $sql = "SELECT * FROM reservations 
                INNER JOIN events 
                ON reservations.event_id=events.eventID 
                WHERE reservations.user_id='$user_id' AND events.date > '$date';";
      
      $result = $database->query($sql);

      if(!$result){
          Session::setErrorFeedback("Trenutno postoje problemi sa dohvatanjem rezervacija korsinika. Molimo vas pokusajte kasnije!");
          return false;
      }

      $array = $result->fetch_all(MYSQLI_ASSOC);
      return $array;
    }
    
    public static function getReservationById($reservation_id){
        
        $date_time = new DateTime();
        $date = $date_time->format('Y-m-d');

        $database = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM reservations 
                WHERE reservationID='$reservation_id'";
        
        $result = $database->query($sql);

        if(!$result){
            Session::setErrorFeedback("Trenutno postoje problemi sa dohvatanjem rezervacija korsinika. Molimo vas pokusajte kasnije!");
            return false;
        }

        $array = $result->fetch_all(MYSQLI_ASSOC);
        return $array;
    }
    

    public static function addNewReservation($user_id,$event_id,$num_cards){
       /**
        * Not tested yet, pisano napamet
        */
    
      //$result = self::isReservationPossible($event_id,$num_cards);
      //if(!result){ 
      //  return false;
      //}
   
    $database = Database::getInstance()->getConnection();
   
    $sql = "INSERT INTO reservations (user_id,event_id,num_of_cards) VALUES('$user_id','$event_id','$num_cards') "; //dodati redosled kolona  
    $result = $database->query($sql);
      
    if($result === TRUE){

            return $database->insert_id;
          }else{
              Session::setErrorFeedback("Greska prilikom upisa rezervacije.Molim vas pokusajte ponovo kasnije!");
            return false;
          }
    }


    public static function isReservationPossible($event_id,$num_cards)
    {

        $event = Projection::getEventById($event_id);
        $hall = Hall::getHallById($event->hall_id);
        
        if($event->reserved + $num_cards <= $hall->capacity){
          
          $event->reserved = $event->reserved + $num_cards;
          $result = updateEventReservedCnt($event->eventID,$event->reserved);
        
          if($result === TRUE){
            return true;
          }else{
            Session::setInfoFeedback("Rezervacija zahtevanog broja karata nije moguca.");
            return false;
          } 
        }
    }

    public static function deleteReservation($reservationID){
        $database = Database::getInstance()->getConnection();
        $sql = "DELETE FROM reservations WHERE reservationID='$reservationID'";
    	
        $query_result = $database->query($sql);
        if ($query_result === TRUE) {
            Session::setInfoFeedback("Uspesno otkazana rezervacija broj '$reservationID'!" );
            return true;
        }

        Session::setErrorFeedback("Trenutno nismo u mogucnosti da otkazemo vasu rezervaciju!");
        return false;
    }
  }
?>
