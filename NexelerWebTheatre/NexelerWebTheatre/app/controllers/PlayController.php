<?php

class PlayController extends Controller
{
    /*
     * render plays page
     */
	public function plays_page()
	{
		$playId = Request::get('playId',true);
		$play= Play::getPlayByID($playId);
		
		if ($play !=null)
		{
			$this->View->render('pages/play_details', array('play' => $play));
			exit();
		}
		else
		{
			Redirect::to('home/preformances');
			exit();
		}
		
	}
    
	public function create_new()
	{
		$this->View->render('pages/play_new');
		exit();
	}
	
	public function edit()
	{
		$playId = Request::post('playId');
		$play= Play::getPlayByID($playId);
		$this->View->render('pages/play_edit', array('play' => $play));
        exit();
	}
	
	public function create_new_play()
	{
		$playTitle = strip_tags(Request::post('title'));
        $playDescription = strip_tags(Request::post('description'));
		
		$playId = Play::writeNewPlay($playTitle, $playDescription);
		
		if ($playId != 0)
		{
			if (!empty($_FILES['file']['tmp_name']))
			{
				$result = Play::writeNewPlayPicture($playId, $_FILES['file']['tmp_name']);
				if ($result)
				{
					Redirect::to('home/preformances');
					exit();
				}
				else
				{
					Redirect::to('play/create_new_play');
					exit();
				}
			}
			else
			{
				Redirect::to('home/preformances');
				exit();
			}
		}
		else
		{
			Redirect::to('play/create_new_play');
			exit();
		}
	}
	
	public function update()
	{
		$playId = strip_tags(Request::post('playId'));
        $playTitle = strip_tags(Request::post('title'));
        $playDescription = strip_tags(Request::post('description'));
        
		$result = Play::updatePlay( $playId,$playTitle,$playDescription);
		
		if($result)
		{
			if (!empty($_FILES['file']['tmp_name']))
			{
				$picture = Play::getPlayPictureById($playId);
				
				if (empty($picture))
					$result = Play::writeNewPlayPicture($playId, $_FILES['file']['tmp_name']);
				else		
					$result = Play::updatePlayPicture($playId, $_FILES['file']['tmp_name']);
                
				if ($result)
				{
					Redirect::to('home/preformances');
					exit();
				}
				else
				{
					Redirect::to('play/edit_play');
					exit();
				}
			}
			else
			{
				Redirect::to('home/preformances');
				exit();
			}
        }
		else
		{
			Redirect::to('play/edit_play');
			exit();
        }
	}
	
	public function remove($args)
	{
		$playId = Request::post('playId');
		
		Play::deletePlay($playId);
		Play::deletePlayPicture($playId);
		
		Redirect::to('home/preformances');
		exit();
	}
}
?>