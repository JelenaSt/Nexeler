<?php


class EventController extends Controller
{
    

    /*
     * render plays page
     */
    public function eventspage()
    {
        $result = ProjectionManager::fetchTopEvents(3);
       
        $this->View->render('pages/events',array('events' => $result)) ;
        exit();

    }
    
    public function createnewplay()
    {
    }
    
    public function updateplay()
    {
    }
    
}


?>