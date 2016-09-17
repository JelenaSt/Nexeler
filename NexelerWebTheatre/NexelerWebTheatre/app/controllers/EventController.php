<?php


class EventController extends Controller
{
    

    /*
     * render plays page
     */
    public function eventspage()
    {
        //$page=1; 
        $page = Request::get('page') ? Request::get('page') : 1;
		
        $count_of_events = 4;
		$startFrom = ($page - 1) * $count_of_events;
		
		$result = Projection::fetchEventsByPage($startFrom, $count_of_events);
        $numberOfEvents = Projection::numberOfEvents();
		
        $totalPages = ceil($numberOfEvents/$count_of_events);
        
        $this->View->render('pages/events',array('events' => $result, 'events_cnt' => $count_of_events, 'totalPages' => $totalPages, 'curr_page' => $page)) ;
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
        $event_name = strip_tags(Request::post('event_name'));
        $hallId = strip_tags(Request::post('hall_data'));
        $playId = strip_tags(Request::post('play_data'));

        $date = strip_tags(Request::post('date'));
        $time =  strip_tags(Request::post('time')) . ':00';

        Projection::addNewEvent($event_name,$date,$time,$playId,$hallId);
        Redirect::to('event/eventspage');
        exit();
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

    public function delete()
    {
        $eventId = Request::get('eventID');
        
		Projection::deleteEventByID($eventId);
     
        Redirect::to('event/eventspage');

    }

    public function update()
	{
		$eventID = strip_tags(Request::post('eventID'));
        $event_name = strip_tags(Request::post('event_name'));
        $hallId = strip_tags(Request::post('hall_data'));
        $playId = strip_tags(Request::post('play_data'));

        $date = strip_tags(Request::post('test_date'));
        $time =  strip_tags(Request::post('test_time'));
        $date_time =  $date . ' ' . $time . ':00';

        $result = Projection::updateEvent($eventID,$event_name,$date,$time,$playId,$hallId);
		
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