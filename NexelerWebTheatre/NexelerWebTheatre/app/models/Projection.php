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
    var $hall_id;
    var $play_id;

    public function __construct($args)
    {
        $this->eventId = $args['eventID'];
        $this->eventName = $args['event_name'];
        $this->event_time = $args['event_time'];
        $this->hall_id = $args['hall_id'];
        $this->play_id = $args['play_id'];
    }



    public static function addNewEvent($event_name,$event_date, $play_id,$hall_id, $event_date)
    {

        $database = Database::getInstance()->getConnection();
        $sql = "INSERT INTO events (event_name,event_time,hall_id,play_id)
                    VALUES ('$event_name','$event_date','$hall_id', '$play_id')";

        $query_result = mysqli_query($database, $sql);
        //print_r($query_result);
        //$count =  mysqli_num_rows($query_result);
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
            return false;
        }

        
        $array = $result->fetch_all(MYSQLI_ASSOC);
        return $array;
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

        $event = new Projection($array[0]);
        return $event;
    }
}