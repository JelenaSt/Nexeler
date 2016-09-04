<?php

/**
 * home short summary.
 *
 * home description.
 *
 * @version 1.0
 * @author Jelena
 */
class HomeController extends Controller
{
    public function index()
    {
        
        $this->View->render('pages/index');
        exit();
    }

    public function events()
    {
        $count_of_events = 5;
        $result = Projection::fetchTopEvents($count_of_events);
        
        
        $this->View->render('pages/events',array('events' => $result, 'events_cnt' => $count_of_events)) ;
        exit();
        
        //$this->View->render('pages/events',array('events' => $result)) ;
        //exit();


       
        //$message = "wrong answer";
        //if($events)
        //    $message = "smth";
        //else
        //    $message = 'false;';

        ////// This is in the PHP file and sends a Javascript alert to the client
        ////$message = "wrong answer";
        //echo "<script type='text/javascript'>alert('$message');</script>";


        //$events = Event::fetchAllEvents();
       // $this->View->render('pages/events',array('events' => $events));
        //exit();
    }

    public function preformances()
    {
        
        $this->View->render('pages/preformances');
        exit();
    }

    public function artists()
    {
        
        $this->View->render('pages/artists');
        exit();
    }

    public function contact()
    {
        
        $this->View->render('pages/contact');
        exit();
    }


}