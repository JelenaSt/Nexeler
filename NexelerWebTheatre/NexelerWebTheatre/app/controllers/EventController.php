<?php


class EventController extends Controller
{
    

    /*
     * render plays page
     */
    public function eventspage()
    {
        $count_of_events = 5;
        $result = Projection::fetchTopEvents($count_of_events);
       
        $this->View->render('pages/events',array('events' => $result, 'events_cnt' => $count_of_events)) ;
        exit();

    }
    
    public function newevent()
    {
    }
    
    public function edit()
    {
        $eventId = Request::post('eventID');
      
		$event= Projection::getEventByID($eventId);
        $halls = Hall::fetchAllHalls();
        
		$this->View->render('pages/event_edit',array('event' => $event, 'halls' => $halls));

    }
    
}


?>