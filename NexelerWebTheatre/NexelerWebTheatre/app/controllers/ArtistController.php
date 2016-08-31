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
    
	public function createnewaartist()
	{
	}
	
	public function updateartist()
	{
	}
	
	public function deleteartist($args)
	{
	}
	
	
}
?>
