<?php

/**
 * EventsManager short summary.
 *
 * EventsManager description.
 *
 * @version 1.0
 * @author Jelena
 */
class ProjectionManager
{

    public static function fetchTopEvents($count_of_events)
    {
        $events = Projection::fetchAllEvents();
        
        $result_events = array();
        //for($iter = 0; $iter < $count_of_events; $iter++)
       // {

            foreach ($events as $key => $value)
            {
                $play_id = $value["play_id"];
                echo "PREDSTAVA ID: " . $play_id . PHP_EOL;
               

               // print_r( $value);
                $event_model = array('event' => $value , 'play' => Play::getPlayByID($play_id), 'play_picture' => Play::getPlayPictureById($play_id));
               // print_r($event_model);
                array_push($result_events, $event_model);
            }
            //$event_model = array('event' => $events[$iter] , 'play' => Play::getPlayByID($events[$iter]->play_id), 'play_picture' => Play::getPlayPictureById($events[$iter]->play_id));
            //print($event_model);
            //array_push($result_events, $event_model);
       // }

        return $result_events;
    }
}