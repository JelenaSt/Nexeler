<?php

class PlayController extends Controller
{
    /*
     * render plays page
     */
	public function plays_page()
	{
		$this->View->render('pages/play_details');
		exit();
	}
    
	public function createnewplay()
	{
	}
	
	public function edit_play()
	{
		$playId = Request::post('playId');
		$play= Play::getPlayByID($playId);
		$this->View->render('pages/play_edit',array('play' => $play));
        exit();
	}
	
	public function play_update()
	{
		$playId = strip_tags(Request::post('playId'));
        $playTitle = strip_tags(Request::post('title'));
        $playDescription = strip_tags(Request::post('description'));
		
        
        $result = Play::updatePlay( $playId,$playTitle,$playDescription);
        
        if($result){
            Redirect::to('home/preformances');
            exit();
        }else{
            Redirect::to('play/edit_play');
            exit();
        }
	}
	
	public function deleteplay($args)
	{
	}
}
?>