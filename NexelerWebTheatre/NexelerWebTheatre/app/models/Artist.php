<?php

class Artist
{
    var $artistId;
    var $artistName;
    var $artistBiography;
    
    public function __construct($args)
    {
        $this->artistId = $args["ID"];
        $this->artistName = $args["Name"];
        $this->artistBiography = $args["Biography"];
    }
    
    public static function writeNewArtist($artistName,$artistBio)
    {
        $database = Database::getInstance()->getConnection();
		
        $sql = "SELECT MAX(ID) 
                FROM artists";
        
		mysqli_query($database, "set names 'utf8'");	
        $query_result = mysqli_query($database, $sql);
		
        $row = mysqli_fetch_array($query_result);
        $artistId = $row[0] + 1;
		
        $sql = "INSERT INTO artists (ID,Name,Biography)
                VALUES ('$artistId','$artistName','$artistBio')";
        
        $query_result = mysqli_query($database, $sql);
		
        print_r($query_result);
        if ($query_result === TRUE) 
        {
            return $artistId;
        }
        return null;
    }
	
	public static function deleteArtist($artistId)
    {
		$database = Database::getInstance()->getConnection();
		$sql = "DELETE FROM artists 
				WHERE ID='$artistId'";
        
		$query_result = $database->query($sql);
		
		if ($query_result === TRUE) 
		{
			return true;
		}
		return false;
    }
    
    public static function updateArtist($artistId,$artistName,$artistBio)
    {
        $database = Database::getInstance()->getConnection();
        $sql = "UPDATE artists SET Name='$artistName', Biography='$artistBio'
                WHERE ID='$artistId'";
        
		mysqli_query($database, "set names 'utf8'");
        $query_result = $database->query($sql);
        
        if ($query_result === TRUE) 
        {
            return true;
        }
        return false;
    }
    
    public static function fetchAllArtist()
    {
        $database = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM artists";
        mysqli_query($database, "set names 'utf8'");
        $result = mysqli_query($database,$sql);
        
        if ($result->num_rows > 0)
        {
            return $result;
        }
        return NULL;
    }
    
    public static function getArtistByID($artistId)
    {
        $database = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM artists 
                WHERE ID ='$artistId'";
        
		mysqli_query($database, "set names 'utf8'");		 
        $result = mysqli_query($database,$sql);
        
		echo "$artistId".'<br>';
		$num = mysqli_num_rows($result);
		echo "$num";
		
        if(mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_assoc($result);
            $artist = new Artist($row);
            return $artist;	
        }
        return NULL;
    }
    
    public static function getArtistByName($artistName)
    {
        $database = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM artists 
                WHERE Name ='$artistName'";
        
		mysqli_query($database, "set names 'utf8'");
        $result = mysqli_query($database,$sql);
        
        if(mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_assoc($result);
            $artist = new Artist($row);
            return $artist;
        }
        return NULL;
    }
    
    public static function deleteArtistByID($artistId)
    {
        $database = Database::getInstance()->getConnection();
        $sql = "DELETE FROM artists 
                WHERE ID='$artistId'";
        
        $query_result = $database->query($sql);
        
        if ($query_result === TRUE) 
        {
            return true;
        }
        return false;
    }
    
    //picture related methods
    
    public static function getArtistPictureById($artistId)
    {
        $database = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM artistpictures 
                 WHERE ArtistID ='$artistId'";
        $result = mysqli_query($database,$sql);
        
        if(mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_assoc($result);
            return $row['ArtistPicture'];
        }
        return NULL;
    }

	public static function writeNewArtistPicture($artistId, $file_loc)
    {
        //file is not image
		if(getimagesize($file_loc) == false) return false;
		
        if (is_uploaded_file($file_loc))
		{
			$imgData =addslashes(file_get_contents($file_loc));

			$database = Database::getInstance()->getConnection();
			$sql = "INSERT INTO artistpictures(ArtistID, ArtistPicture)
					VALUES('$artistId', '{$imgData}')";
			
			$query_result = $database->query($sql);
			if ($query_result === TRUE) 
			{
				return true;
			}
			return false;
		}
    }
	
	public static function updateArtistPicture($artistId, $file_loc)
    {
        //file is not image
		if(getimagesize($file_loc) == false) return false;
        
        if (is_uploaded_file($file_loc))
		{
			$imgData =addslashes(file_get_contents($file_loc));

			$database = Database::getInstance()->getConnection();
			$sql = "UPDATE artistpictures SET ArtistPicture='{$imgData}'
				   WHERE ArtistID='$artistId'";
			$query_result = $database->query($sql);
			if ($query_result === TRUE) 
			{
				return true;
			}
			return false;
		}
    }
	
	public static function deleteArtistPicture($artistId)
    {
        $database = Database::getInstance()->getConnection();
        $sql = "DELETE FROM artistpictures 
                WHERE ArtistID='$artistId'";
        
        $query_result = $database->query($sql);
        
        if ($query_result === TRUE) 
        {
            return true;
        }
        return false;
    }
    
}
