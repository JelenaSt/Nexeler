<?php

class Play
{
	var $playId;
	var $playTitle;
	var $description;
    
	public function __construct($args)
    {
        $this->playId = $args['ID'];
        $this->playTitle = $args['Title'];
        $this->description = $args['Description'];
    }
    
	public static function writeNewPlay($playTitle,$description)
    {
        $database = Database::getInstance()->getConnection();

        $sql = "SELECT MAX(ID) 
				FROM plays";
        
		mysqli_query($database, "set names 'utf8'");		
        $query_result = mysqli_query($database, $sql);
        
        $row = mysqli_fetch_array($query_result);
        $playId = $row[0] + 1;

        $sql = "INSERT INTO plays (ID,Title,Description)
                    VALUES ('$playId','$playTitle','$description')";
        
        $query_result = mysqli_query($database, $sql);
		
        print_r($query_result);
        if ($query_result === TRUE) {
            return $playId;
        }
        return null;
    }
	
	public static function deletePlay($play_id)
    {
		$database = Database::getInstance()->getConnection();
		$sql = "DELETE FROM plays 
				WHERE ID='$play_id'";
        
		$query_result = $database->query($sql);
		
		if ($query_result === TRUE) 
		{
			return true;
		}
		return false;
    }
    
    public static function getPlayByID($play_id)
    {
        $database = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM plays 
				WHERE ID ='$play_id'";
        
		mysqli_query($database, "set names 'utf8'");	
        $result = mysqli_query($database,$sql);
        
        if(mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_assoc($result);
            $play= new Play($row);
            return $play;
        }
        return NULL;
    }
    
    public static function getPlayByName($play_name)  
    {
        $database = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM plays where Title ='$play_name'";
		mysqli_query($database, "set names 'utf8'");	
        $result = mysqli_query($database,$sql);
        if(mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_assoc($result);
            
            $play= new Play($row);
            return $play;
        }

        return NULL;
    }
	
	public static function updatePlay($playId,$playTitle,$playDescription)
	{
		$database = Database::getInstance()->getConnection();
        $sql = "UPDATE plays SET Title='$playTitle',Description='$playDescription' 
				WHERE ID='$playId'";
        
        mysqli_query($database, "set names 'utf8'");
        $query_result = $database->query($sql);
        if ($query_result === TRUE) {
            return true;
        }
        return false;
	}
    
    public static function fetchAllPlays()  
    {
        $database = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM plays";
		
        mysqli_query($database, "set names 'utf8'");
		
        $result = mysqli_query($database,$sql);
        if ($result->num_rows > 0)
        {
            return $result;
        }
        return NULL;
    }
    
    public static function deletePlayByID($play_id)
    {
        $database = Database::getInstance()->getConnection();
    	
    	$sql = "DELETE FROM play WHERE ID='$play_id'";
    	
        $query_result = $database->query($sql);
        if ($query_result === TRUE) {
            return true;
        }
        return false;
    }

    public static function getPlayPictureById($play_id)
    {
        $database = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM playpictures where PlayID ='$play_id'";

        $result = mysqli_query($database,$sql);
        if(mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_assoc($result);
            return $row['PlayPicture'];
        }
        return NULL;
    }
	
	public static function writeNewPlayPicture($play_id, $file_loc)
    {
		//file is not image
		if(getimagesize($file_loc) == false) return false;
		
        if (is_uploaded_file($file_loc))
		{
			$imgData =addslashes(file_get_contents($file_loc));

			$database = Database::getInstance()->getConnection();
			$sql = "INSERT INTO playpictures(PlayID, PlayPicture)
					VALUES('$play_id', '{$imgData}')";
			
			$query_result = $database->query($sql);
			if ($query_result === TRUE) 
			{
				return true;
			}
			return false;
		}
    }
	
	public static function updatePlayPicture($play_id, $file_loc)
    {
		//file is not image
		if(getimagesize($file_loc) == false) return false;
        
        if (is_uploaded_file($file_loc))
		{
			$imgData =addslashes(file_get_contents($file_loc));

			$database = Database::getInstance()->getConnection();
			$sql = "UPDATE playpictures SET PlayPicture='{$imgData}'
				   WHERE PlayID='$play_id'";
			$query_result = $database->query($sql);
			if ($query_result === TRUE) 
			{
				return true;
			}
			return false;
		}
    }
	
	public static function deletePlayPicture($play_id)
    {
		$database = Database::getInstance()->getConnection();
		$sql = "DELETE FROM playpictures 
				WHERE PlayID='$play_id'";
        
		$query_result = $database->query($sql);
		
		if ($query_result === TRUE) 
		{
			return true;
		}
		return false;
    }

}
