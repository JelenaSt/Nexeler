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
    
    public static function fetchAllReservations(){
        
        $date_time = new DateTime();
        $date = $date_time->format('Y-m-d');

        $database = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM reservations 
                INNER JOIN events 
                ON reservations.event_id=events.eventID 
                WHERE events.date > '$date';";
        
        $result = $database->query($sql);

        if(!$result){
            Session::setErrorFeedback("Trenutno postoje problemi sa dohvatanjem rezervacija korsinika. Molimo vas pokušajte kasnije!");
            return false;
        }
        $array = $result->fetch_all(MYSQLI_ASSOC);
        return $array;
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
          Session::setErrorFeedback("Trenutno postoje problemi sa dohvatanjem rezervacija korsinika. Molimo vas pokušajte kasnije!");
          return false;
      }

      $array = $result->fetch_all(MYSQLI_ASSOC);
      return $array;
    }

    public static function getReservationsForEvent($event_id){
        
        $date_time = new DateTime();
        $date = $date_time->format('Y-m-d');

        $database = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM reservations 
                INNER JOIN events 
                ON reservations.event_id=events.eventID 
                WHERE reservations.event_id='$event_id' AND events.date > '$date';";
        
        $result = $database->query($sql);

        if(!$result){
            Session::setErrorFeedback("Trenutno postoje problemi sa dohvatanjem rezervacija korsinika. Molimo vas pokušajte kasnije!");
            return false;
        }

        $array = $result->fetch_all(MYSQLI_ASSOC);
        return $array;
    }
    
     public static function filterReservations($playName,$datum,$userId,$name){
        
        $date_time = new DateTime();
        $date = $date_time->format('Y-m-d');

        $database = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM reservations 
               INNER JOIN events 
               ON reservations.event_id=events.eventID 
               INNER JOIN plays
               ON events.play_id = plays.ID
               INNER JOIN users
               ON reservations.user_id = users.userID";
       $where = false;
       if($playName){
         $sql = $sql . " WHERE plays.Title LIKE '%$playName%'";
                $where = true;
        }
        if($name){
            if(!$where){
                 $sql = $sql . " WHERE ";
                  $where = true;
            }
            else{
                $sql = $sql . " AND ";
            }
            $sql = $sql . "(users.name LIKE '%$name%' OR  users.last_name LIKE '%$name%')";
        }

        if($userId){
         if(!$where){
                 $sql = $sql . " WHERE ";
                  $where = true;
            }
            else{
                $sql = $sql . " AND ";
            }
         $sql = $sql . "users.userID LIKE '%$userId%'";
        }

        if($datum){
         if(!$where){
                 $sql = $sql . " WHERE ";
                  $where = true;
            }
            else{
                $sql = $sql . " AND ";
            }
          $sql = $sql . "events.date = '$datum'";
        }
     //$sql = "SELECT * FROM reservations 
     //           INNER JOIN events 
     //           ON reservations.event_id=events.eventID 
     //           INNER JOIN plays
     //           ON events.play_id = plays.ID
     //           WHERE plays.Title LIKE '%$playName%'";
        
        $result = $database->query($sql);

        if(!$result){
            Session::setErrorFeedback("Trenutno postoje problemi sa dohvatanjem rezervacija korsinika. Molimo vas pokušajte kasnije!");
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
            Session::setErrorFeedback("Trenutno postoje problemi sa dohvatanjem rezervacija korsinika. Molimo vas pokušajte kasnije!");
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
              Session::setErrorFeedback("Greška prilikom upisa rezervacije.Molim vas pokušajte ponovo kasnije!");
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
            Session::setInfoFeedback("Rezervacija zahtevanog broja karata nije mogu?a.");
            return false;
          } 
        }
    }

    public static function deleteReservation($reservationID){
        $database = Database::getInstance()->getConnection();
        $sql = "DELETE FROM reservations WHERE reservationID='$reservationID'";
    	
        $query_result = $database->query($sql);
        if ($query_result === TRUE) {
            Session::setInfoFeedback("Uspešno otkazana rezervacija broj '$reservationID'!" );
            return true;
        }

        Session::setErrorFeedback("Trenutno nismo u mogu?nosti da otkaemo vašu rezervaciju!");
        return false;
    }
  }
?>
