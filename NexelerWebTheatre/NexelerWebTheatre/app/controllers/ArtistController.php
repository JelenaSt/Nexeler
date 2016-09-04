<?php

class ArtistController extends Controller
{
	/*
     * render actors page
     */
	public function artistpage()
	{
		$this->View->render('pages/artist_details');
		exit();
	}
    
	public function create_new()
	{
		$this->View->render('pages/artist_new');
		exit();
	}
	
	public function edit()
	{
		$artistId = Request::post('artistId');
		$artist= Artist::getArtistByID($artistId);
		$this->View->render('pages/artist_edit',array('artist' => $artist));
        exit();
	}
	
	public function create_new_artist()
	{
		$artistName = strip_tags(Request::post('name'));
        $artistBiography = strip_tags(Request::post('biography'));
		
		$artistId = Artist::writeNewArtist($artistName, $artistBiography);
		
		if ($artistId != 0)
		{
			if (!empty($_FILES['file']['tmp_name']))
			{
				$result = Artist::writeNewArtistPicture($artistId, $_FILES['file']['tmp_name']);
				if ($result)
				{
					Redirect::to('home/artists');
					exit();
				}
				else
				{
					Redirect::to('artist/create_new_artist');
					exit();
				}
			}
			else
			{
				Redirect::to('home/artists');
				exit();
			}
		}
		else
		{
			Redirect::to('artist/create_new_artist');
			exit();
		}
	}
	
	public function update()
	{
		$artistId = strip_tags(Request::post('artistId'));
        $artistName = strip_tags(Request::post('name'));
        $artistBiography = strip_tags(Request::post('biography'));
        
		//echo 'Artist id: '."$artistId".'<br>';
		if ($artistId != 0)
		{
			$result = Artist::updateArtist($artistId, $artistName, $artistBiography);
            
			if ($result)
			{
				if (!empty($_FILES['file']['tmp_name']))
				{
					$picture = Artist::getArtistPictureById($artistId);
					
					if (empty($picture))
						$result = Artist::writeNewArtistPicture($artistId, $_FILES['file']['tmp_name']);
					else		
						$result = Artist::updateArtistPicture($artistId, $_FILES['file']['tmp_name']);
                    
					if ($result)
					{
						Redirect::to('home/artists');
						exit();
					}
					else
					{
						Redirect::to('artist/edit');
						exit();
					}
				}
				else
				{
					Redirect::to('home/artists');
					exit();
				}
			}

		}
		
		Redirect::to('artist/edit');
		exit();
	}
	
	public function remove()
	{
		$artistId = Request::post('artistId');
		
		Artist::deleteArtist($artistId);
		Artist::deleteArtistPicture($artistId);
		
		Redirect::to('home/artists');
		exit();
	}
	
	
}
?>
