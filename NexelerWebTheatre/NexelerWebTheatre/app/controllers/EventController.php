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

    public function addnew()
    {
        $halls = Hall::fetchAllHalls();
        $plays = Play::fetchAllPlays();
        
		$this->View->render('pages/event_new',array('halls' => $halls, 'plays' => $plays));
        exit();
    }

    public function newevent()
    {
    }
    
    public function edit()
    {
        $eventId = Request::get('eventID');
      
		$event= Projection::getEventByID($eventId);
        $halls = Hall::fetchAllHalls();
        $plays = Play::fetchAllPlays();
        
		$this->View->render('pages/event_edit',array('event' => $event, 'halls' => $halls, 'plays' => $plays));
        exit();

    }

    public function update()
	{
		$eventID = strip_tags(Request::post('eventID'));
        $event_name = strip_tags(Request::post('event_name'));
        $event_time = strip_tags(Request::post('event_time'));
        $hallId = strip_tags(Request::post('hall_data'));
        $playId = strip_tags(Request::post('play_data'));

		$result = Projection::updateEvent($eventID,$event_name,$event_time,$playId,$hallId);
		
        if($result){
            Redirect::to('event/eventspage');
            exit();
        }else{
            Redirect::to('event/eventspage');
            exit();
        }
	}
	
    
}


?>