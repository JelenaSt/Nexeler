<?php

/**
 * Event short summary.
 *
 * Event description.
 *
 * @version 1.0
 * @author Jelena
 */
class Projection
{

    var $eventId;
    var $eventName;
    var $event_time;
    var $date;
    var $time;
    var $hall_id;
    var $play_id;
    var $reserved;
    
    public function __construct($args)
    {
        $this->eventId = $args['eventID'];
        $this->eventName = $args['event_name'];
        $this->event_time = $args['event_time'];
        $this->date = $args['date'];
        $this->time = $args['time'];
        $this->hall_id = $args['hall_id'];
        $this->play_id = $args['play_id'];
        //$this->reserved = $args['reserved'];
    }

    public static function addNewEvent($event_name,$date,$time, $play_id,$hall_id)
    {

        $database = Database::getInstance()->getConnection();
        $sql = "INSERT INTO events (event_name,date,time,hall_id,play_id)
                    VALUES ('$event_name','$date','$time','$hall_id', '$play_id')";

        $query_result = mysqli_query($database, $sql);
        print_r($query_result);
        //$count =  mysqli_num_rows($query_result);
        if ($query_result === TRUE) {
            Session::setInfoFeedback("Uspesno kreiran nov zapis!");
            return true;
        }

        Session::setInfoFeedback("Greska prilikom kreiranja novog zapisa.!" . mysqli_error($database));
        return false;
    }

    public static function updateEvent($eventID,$event_name,$date,$time, $play_id,$hall_id)
    {

        $database = Database::getInstance()->getConnection();
        $sql = "UPDATE events SET event_name='$event_name',date='$date',time='$time',hall_id='$hall_id',play_id='$play_id'
				WHERE eventID='$eventID'";

        $query_result = mysqli_query($database, $sql);

        if ($query_result === TRUE) {
            Session::setInfoFeedback("Uspesno azurirani detalji projekcije!");
            return true;
        }

        Session::setInfoFeedback("Greska prilikom azuriranja detalja projekcije!");
        
        return false;
    }
    
     public static function updateEventReservedCnt($eventID,$new_reservation)
    {

        $database = Database::getInstance()->getConnection();
        $sql = "UPDATE events SET reserved='$new_reservation' WHERE eventID='$eventID'";

        $query_result = mysqli_query($database, $sql);

        if ($query_result === TRUE) {
            return true;
        }

        return false;
    }

    /*
     *	Fetch all events
     */
    public static function fetchAllEvents()
    {
    	$database = Database::getInstance()->getConnection();
    	$sql = "SELECT * FROM events ORDER BY eventID";
        
        $result = $database->query($sql);
        if(!$result){
            return false;
        }

       
        $array = $result->fetch_all(MYSQLI_ASSOC);
        return $array;
    }

    public static function fetchTopEvents($count)
    {
    	$database = Database::getInstance()->getConnection();
    	$sql = "SELECT * FROM events  LIMIT " . $count . ';';
        
        $result = $database->query($sql);
        if(!$result){
            Session::setErrorFeedback("Greska u procesiranju vaseg zahteva. Molimo vas pokusajte kasnije ponovo.");
            return false;
        }

        $array = $result->fetch_all(MYSQLI_ASSOC);
        return $array;
    }
	
	 public static function fetchEventsByPage($uperLimit, $count) 
	 {
	        $database = Database::getInstance()->getConnection();
	        $sql = "SELECT * FROM events
					ORDER BY Date ASC LIMIT $uperLimit, $count";
			
	        mysqli_query($database, "set names 'utf8'");
	        $result = $database->query($sql);
	        if(!$result){
	       	    Session::setErrorFeedback("Greska u procesiranju vaseg zahteva. Molimo vas pokusajte kasnije ponovo.");
	            return false;
	        }
	
	        $array = $result->fetch_all(MYSQLI_ASSOC);
	        return $array;
    	}
	
	public static function numberOfEvents()
	{
		$database = Database::getInstance()->getConnection();
        	$sql = "SELECT COUNT(*) FROM events";
		
        	$result = mysqli_query($database,$sql);
		
		$row = mysqli_fetch_row($result); 
		$totalRecords = $row[0]; 
		
		return $totalRecords;
	}

    public static function getEventByID($event_id)
    {
    	$database = Database::getInstance()->getConnection();
    	$sql = "SELECT * FROM events  WHERE eventID = '$event_id'";
        
        $result = $database->query($sql);
        if(!$result){
            return false;
        }

        $array = $result->fetch_all(MYSQLI_ASSOC);
        if($array){
            $event = new Projection($array[0]);
            return $event;
        }
        return NULL;
    }


    public static function deleteEventByID($event_id)
    {
    	$database = Database::getInstance()->getConnection();
    	$sql = "DELETE FROM events  WHERE eventID = '$event_id'";
        
        $result = $database->query($sql);
        if(!$result){
            Session::setErrorFeedback("Greska u procesiranju vaseg zahteva. Molimo vas pokusajte kasnije ponovo.");
            return false;
        }

        Session::setErrorFeedback("Dogadjaj je uspesno obrisan sa reperoara.");
        return true;
    }
}
