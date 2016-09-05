<?php
  class Registration{
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
    
      $date = new DateTime();
      $date = $date->getTimestamp();

      $database = Database::getInstance()->getConnection();
      $sql = "SELECT * FROM reservations INNER JOIN events ON reservations.event_id=events.eventID WHERE reservations.user_id='$user_id' AND events.date > '$date->format(Y-m-d)'";
      
      //...nastavak
    }
    
    public static function addNewReservation($user_id,$event_id,$num_cards){
        $database = Database::getInstance()->getConnection();
        $sql = "INSERT INTO reservations (user_id,event_id,num_of_cards) VALUES('$user_id','$event_id','$num_cards') "; //dodati redosled kolona
      
      $result = $database->query($sql);
      
      if($result === TRUE){
          Session::setInfoFeedback("Uspesno kreiran nov zapis!");
        return true;
      }else{
          Session::setInfoFeedback("Greska prilikom upisa rezervacije.Molim vas pokusajte ponovo kasnije!");
        return false;
      }
    }
  }
?>
