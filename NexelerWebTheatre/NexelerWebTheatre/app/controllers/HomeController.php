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
        $count_of_events = 6;
        $result = Projection::fetchTopEvents($count_of_events);
        
        
        $this->View->render('pages/events',array('events' => $result, 'events_cnt' => $count_of_events)) ;
        exit();

    }

    public function preformances()
    {
        $page=1; 
        if (isset($_GET["page"])) $page = Request::get('page');
		
		$playsByPage = 2;
		$startFrom = ($page - 1) * $playsByPage;
		
		$plays = Play::fetchPlaysByPage($startFrom,$playsByPage);
		$numberOfPlays = Play::numberOfPlays();
		
		$totalPages = ceil($numberOfPlays/$playsByPage); 
		
        $this->View->render('pages/preformances', array('plays' => $plays, 'totalPages' => $totalPages));
        exit();
    }

    public function artists()
    {
		$page=1; 
        if (isset($_GET["page"])) $page = Request::get('page');
	
		$artistsByPage = 2;
		$startFrom = ($page - 1) * $artistsByPage; 
		
		$artists = Artist::fetchArtistsByPage($startFrom,$artistsByPage);
		$numberOfArtists = Artist::numberOfArtists();
		
		$totalPages = ceil($numberOfArtists/$artistsByPage); 
		
        $this->View->render('pages/artists', array('artists' => $artists, 'totalPages' => $totalPages));
        exit();
    }

    public function contact()
    {
        
        $this->View->render('pages/contact');
        exit();
    }


}